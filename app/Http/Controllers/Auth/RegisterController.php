<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function postRegister(RegisterRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->r_email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->password = bcrypt($request->r_password);
            $user->save();
            Auth::guard('users')->loginUsingId($user->id, true);

            \DB::commit();
            return redirect()->route('page.home');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể đăng ký tài khoản');
        }
    }
}
