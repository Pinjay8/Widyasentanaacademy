<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "email" => ["required", "string", "max:255"],
            "password" => ["required", "string", "max:255"],
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
            "email.required" => "Email tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong",
        ];
    }
}
