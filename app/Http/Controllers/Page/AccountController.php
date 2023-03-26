<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateInfoAccountRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Models\Transaction;
use App\Models\ProductCart;

class AccountController extends Controller
{
    //
    public function infoAccount()
    {
        $user= Auth::guard('users')->user();
        return view('page.auth.account', compact('user'));
    }

    public function updateInfoAccount(UpdateInfoAccountRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user =  User::find(Auth::guard('users')->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->save();
            \DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể cập nhật tài khoản');
        }
    }

    public function transactionUser(Request $request)
    {
        $transactions = Transaction::where('tst_user_id', Auth::guard('users')->user()->id)->pluck('id')->toArray();
        $products = ProductCart::with('product')->whereIn('pc_transaction_id', $transactions)->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        $status = Transaction::STATUS;
        $classStatus = Transaction::CLASS_STATUS;

        return view('page.auth.transaction', compact('products', 'status', 'classStatus'));
    }

    public function changePassword()
    {
        return view('page.auth.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user =  User::find(Auth::guard('users')->user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            \DB::commit();
            Auth::guard('users')->logout();
            return redirect()->route('page.user.account')->with('success', 'Đổi mật khẩu thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể đổi mật khẩu');
        }
    }

    public function cancelOrder($id)
    {
        \DB::beginTransaction();
        try {
            $productCart = ProductCart::find($id);

            if (!$productCart) {
                return response([
                    'status_code' => 404,
                    'message' => 'Không thể hủy đơn hàng',
                ]);
            }
            $productCart->pc_status = 4;
            $productCart->user_cancel = 1;
            $productCart->save();
            \DB::commit();

            return response([
                'status_code' => 200,
                'message' => 'Hủy thành công đơn hàng',
            ]);
        } catch (\Exception $exception) {
            \DB::rollBack();
            $code = 404;
            return response([
                'status_code' => $code,
                'message' => 'Không thể hủy đơn hàng',
            ]);
        }
    }
    public function watched(Request $request)
    {
        return view('page.auth.watched');
    }
}
