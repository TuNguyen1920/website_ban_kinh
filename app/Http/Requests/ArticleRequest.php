<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'a_name' => 'required | max:191 | unique:articles,a_name,'.$this->id,
            'a_category_id' => 'required',
            'a_description' => ['nullable', 'max:180'],
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'a_name.required' => 'Dữ liệu không thể để trống',
            'a_name.unique' => 'Dữ liệu đã bị trùng',
            'a_name.max' => 'Vượt quá số ký tự cho phép',
            'a_category_id.required' => 'Dữ liệu không thể để trống',
            'a_description.max' => 'Vượt quá số ký tự cho phép',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
        ];
    }
}
