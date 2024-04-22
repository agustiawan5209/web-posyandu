<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRiwayatImunisasiRequest extends FormRequest
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
            // 'data_imunisasi' => 'required|array',
            // 'data_imunisasi.*.berat_badan' => 'required|numeric',
            // 'data_imunisasi.*.tinggi_badan' => 'required|numeric',
            // 'data_imunisasi.*.lingkar_kepala' => 'required|numeric',
            // 'data_imunisasi.*.kesehatan' => 'required|string',
            'nama_orang_tua'=> 'required|string|max:50',
            'nama_anak'=> 'required|string|max:50',
            'kesehatan'=> 'required|string|max:20',
            'berat_badan'=> 'required|string|max:20',
            'tinggi_badan'=> 'required|string|max:20',
            'lingkar_kepala'=> 'required|string|max:20',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
        ];
    }
}
