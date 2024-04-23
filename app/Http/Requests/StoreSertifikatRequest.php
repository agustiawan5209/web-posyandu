<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSertifikatRequest extends FormRequest
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
            'balita_id' => 'required|integer|exists:balitas,id',
            'nik' => 'required|string|max:50',
            'nama_anak' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:50',
            'jenkel' => 'required|string|in:Laki-Laki,Perempuan',
            'nama_orang_tua' => 'required|string|max:50',
            'alamat_orang_tua' => 'required|string|max:100',
            'no_telpon_orang_tua' => 'required|string|max:15',
            // 'file' => 'required|string',
        ];
    }
}
