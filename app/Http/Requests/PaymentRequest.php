<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'phone'  => 'required|max:191',
            'address'  => 'required|max:191',
            'email' => 'required|email|max:191',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào họ tên',
            'name.max' => 'Họ tên vượt quá số ký tự cho phép',
            'email.required' => 'Vui lòng nhập vào email',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email vượt quá số ký tự cho phép',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng',
            'address.max' => 'Địa chỉ nhận hàng vượt quá số ký tự cho phép',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ',

        ];
    }
}
