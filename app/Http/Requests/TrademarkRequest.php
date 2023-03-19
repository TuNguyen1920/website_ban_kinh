<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrademarkRequest extends FormRequest
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
            'td_name' => 'required | max:191',
            'td_link' => ['nullable', 'max:250'],
            'td_description' => ['nullable', 'max:250'],
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'td_name.required' => 'Dữ liệu không thể để trống',
            'td_name.max' => 'Vượt quá số ký tự cho phép',
            'td_link.max' => 'Vượt quá số ký tự cho phép',
            'td_description.max' => 'Vượt quá số ký tự cho phép',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
        ];
    }
}
