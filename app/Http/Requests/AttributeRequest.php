<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'a_name' => 'required | max:191 | unique:attributes,a_name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'a_name.required' => 'Dữ liệu không thể để trống',
            'a_name.unique' => 'Dữ liệu đã bị trùng',
            'a_name.max' => 'Vượt quá số ký tự cho phép',
        ];
    }
}
