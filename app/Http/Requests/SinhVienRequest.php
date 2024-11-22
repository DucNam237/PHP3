<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinhVienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ma_sinh_vien'    => 'required|max:20|unique:sinh_viens,ma_sinh_vien,' . $this->sinhVien ,
            'ten_sinh_vien'   => 'required|string|max:255',
            'ngay_sinh'       => 'required|date',
            'so_dien_thoai'   => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'hinh_anh'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trang_thai'      => 'required|boolean',
        ];
    }
}
