<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'sd_title' => 'required | max:191 | unique:slides,sd_title,'.$this->id,
            'sd_image'  => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'files.*'  => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'sd_target' => 'required',
            'sd_active' => 'required',
            'sd_sort' => 'required|integer|unique:slides,sd_sort,'.$this->id
        ];
    }
    public function messages()
    {
        return [
            'sd_title.required' => 'Dữ liệu không thể để trống',
            'sd_title.unique' => 'Dữ liệu đã bị trùng',
            'sd_title.max' => 'Vượt quá số ký tự cho phép',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.max' => 'Vượt quá kích thước cho phép',
            'files.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'files.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
            'files.max' => 'Vượt quá kích thước cho phép',
            'sd_target.required' => 'Dữ liệu không thể để trống',
            'sd_active.required' => 'Dữ liệu không thể để trống',
            'sd_sort.required' => 'Dữ liệu không thể để trống',
            'sd_sort.integer' => 'Vui lòng nhập só nguyên',
            'sd_sort.unique' => 'Dữ liệu đã bị trùng',
        ];
    }
}
