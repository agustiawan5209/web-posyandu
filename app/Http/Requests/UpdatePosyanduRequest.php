<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePosyanduRequest extends FormRequest
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
        {
            return [
                'slug'=> 'required|numeric|exists:posyandus,id',
                'nama'=>'required|string|sometimes|max:50|unique:posyandus,nama',
                'alamat'=> 'required|string|sometimes|max:100',

            ];
        }
    }
}
