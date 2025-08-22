<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'syarat' => 'nullable|string',
            'waktu_layanan' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'status_aktif' => 'boolean',
            'ikon' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ];
    }
}
