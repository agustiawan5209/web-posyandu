<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiPosyanduRequest extends FormRequest
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
            'slug' => 'required|integer|exists:pegawai_posyandus,id',
            // 'user_id' => 'sometimes|required|integer|exists:users,id',
            'jabatan' => '|required',
            'name' => '|required|string|max:255',
            'no_telpon' => '|required|string|max:255',
            'alamat' => '|required|string',
            'name' => '|required|string|max:255',
            // 'username' => 'sometimes|string|max:255|unique:users,username',
            // 'email' => 'sometimes|string|lowercase|email|max:255|unique:'.User::class,
            // 'password' => ['required','string'],
        ];
    }
}
