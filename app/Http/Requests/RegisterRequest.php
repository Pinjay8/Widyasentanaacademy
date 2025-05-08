<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "max:255"],
            "no_telp" => ["required", "string", "max:255"],
            "password" => ["required", "string", "max:255", "confirmed"],
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            "name.required" => "Nama tidak boleh kosong",
            "email.required" => "Email tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong",
            "no_telp.required" => "No Telepon tidak boleh kosong",
            "password.confirmed" => "Password tidak sama dengan konfirmasi password",
            "password_confirmation.required" => "Konfirmasi password tidak boleh kosong",
            "password_confirmation.same" => "Konfirmasi password tidak cocok dengan password.",
        ];
    }
}
