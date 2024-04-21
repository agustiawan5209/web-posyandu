<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiwayatImunisasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => 'required|integer|exists:riwayat_imunisasis,id',
            'balita_id' => 'required|integer|exists:balitas,id',
            'data' => 'required|array',
            'data.*.berat_badan' => 'required|numeric',
            'data.*.kesehatan' => 'required|string',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
        ];
    }
}
