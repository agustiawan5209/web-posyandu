<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBalitaRequest extends FormRequest
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
            'slug' => 'required|integer|exists:balitas,id',
            'nik' => 'required|numeric|max:16',
            'nama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenkel' => 'required|string|in:Laki-Laki,Perempuan',
            'org_tua_id' => 'required|integer|exists:orang_tuas,id',
        ];
    }
}
