<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CapnhatdanhmucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'tendanhmuc' => trim((string) $this->tendanhmuc),
            'mota' => $this->mota ? trim((string) $this->mota) : null,
            'thutu' => $this->filled('thutu') ? (int) $this->thutu : 0,
            'trangthai' => $this->trangthai ?: 'hien',
        ]);
    }

    public function rules(): array
    {
        return [
            'tendanhmuc' => ['required', 'string', 'max:180'],
            'mota' => ['nullable', 'string', 'max:500'],
            'thutu' => ['required', 'integer', 'min:0'],
            'trangthai' => ['required', 'in:hien,an'],
        ];
    }

    public function messages(): array
    {
        return [
            'tendanhmuc.required' => 'Vui lòng nhập tên danh mục.',
            'tendanhmuc.max' => 'Tên danh mục không được vượt quá 180 ký tự.',

            'mota.max' => 'Mô tả không được vượt quá 500 ký tự.',

            'thutu.required' => 'Vui lòng nhập thứ tự hiển thị.',
            'thutu.integer' => 'Thứ tự hiển thị phải là số nguyên.',
            'thutu.min' => 'Thứ tự hiển thị không được nhỏ hơn 0.',

            'trangthai.required' => 'Vui lòng chọn trạng thái.',
            'trangthai.in' => 'Trạng thái danh mục không hợp lệ.',
        ];
    }
}
