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
            'balita_id' => 'required|integer|exists:balitas,id',
            'data' => 'required|array',
            'data.*.berat_badan' => 'required|numeric',
            'data.*.kesehatan' => 'required|string',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
        ];
    }
}
