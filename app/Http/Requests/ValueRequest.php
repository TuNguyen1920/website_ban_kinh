<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValueRequest extends FormRequest
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
            'v_name' => 'required | max:191 | unique:values,v_name,'.$this->id,
            'v_attribute_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'v_name.required' => 'Dữ liệu không thể để trống',
            'v_name.unique' => 'Dữ liệu đã bị trùng',
            'v_name.max' => 'Vượt quá số ký tự cho phép',
            'v_attribute_id.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
