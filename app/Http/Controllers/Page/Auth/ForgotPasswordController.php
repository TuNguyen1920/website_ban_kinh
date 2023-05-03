<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\EmailResetRequest;
use App\Http\Requests\UserRequestNewPassword;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Helpers\MailHelper;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgotPassword()
    {
        return view('page.auth.forgot_password');
    }

    public function sendMailResetPassword(EmailResetRequest $request)
    {
        $account = \DB::table('users')->where('email', $request->email)->first();

        if ($account) {
            // gửi email
            $token = randString(64);

            \DB::table('password_resets')
                ->insert([
                    'email' => $account->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

            $link = route('page.new.password', $token);
            MailHelper::sendMail($account, $link);

            return redirect()->back()->with('success', 'Vui lòng check mail để thay đổi mật khẩu');
        }

        return redirect()->back()->with('error', 'Email đăng ký không thành công.');
    }

    public function newPassword($token)
    {

        $checkToken = \DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$checkToken)  return redirect()->route('page.home')->with('error', 'Token không tồn tại.');

        $now = Carbon::now();

        if ($now->diffInMinutes($checkToken->created_at) > 10) {
            \DB::table('password_resets')->where('token', $token)->delete();
            return redirect()->route('page.home')->with('error', 'Token đã hết hạn.');
        }

        return view('page.auth.reset_passwords', compact('token'));
    }

    public function postNewPassword(UserRequestNewPassword $request, $token)
    {
        $password = $request->password;
        $data['password']   =  Hash::make($password);

        $checkToken = \DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$checkToken)  return redirect()->route('page.home')->with('error', 'Token không tồn tại.');

        try {
            \DB::table('users')->where('email', $checkToken->email)
                ->update($data);

            \DB::table('password_resets')->where('email', $checkToken->email)->delete();

            return redirect()->route('page.user.account')->with('success', 'Đổi mật khẩu thành công vui lòng đăng nhập');
        } catch (\Exception $exception) {
            return redirect()->route('page.home')->with('error', 'Token đã hết hạn.');
        }
    }
}
