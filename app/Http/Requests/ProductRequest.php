<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'pro_name' => 'required | max:191 | unique:products,pro_name,'.$this->id,
            'pro_category_id' => 'required',
            'pro_trademark_id' => 'required',
            'images'  => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'files.*'  => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'types' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'pro_name.required' => 'Dữ liệu không thể để trống',
            'pro_name.unique' => 'Dữ liệu đã bị trùng',
            'pro_name.max' => 'Vượt quá số ký tự cho phép',
            'pro_category_id.required' => 'Dữ liệu không thể để trống',
            'pro_trademark_id.required' => 'Dữ liệu không thể để trống',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.max' => 'Vượt quá kích thước cho phép',
            'files.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'files.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
            'files.max' => 'Vượt quá kích thước cho phép',
            'types.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
