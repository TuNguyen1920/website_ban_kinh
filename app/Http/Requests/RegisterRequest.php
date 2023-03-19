<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'  => 'required|max:191',
            'r_email' => 'required|email|max:191|unique:users,email,'.$this->id,
            'phone' => 'required',
            'r_password' => 'required',
            'password_confirm' => 'required|same:r_password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào họ tên',
            'r_email.required' => 'Vui lòng nhập vào email đăng nhập',
            'r_email.unique' => 'Email đăng nhập không thể trùng lặp',
            'r_email.max' => 'Email vượt quá số ký tự cho phép',
            'r_password.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'password_confirm.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'password_confirm.same' => 'Mật khẩu không trùng khớp',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ',

        ];
    }
}
