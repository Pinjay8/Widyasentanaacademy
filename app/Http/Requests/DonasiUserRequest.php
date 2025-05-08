<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonasiUserRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Jumlah donasi harus diisi.',
            'amount.numeric' => 'Jumlah donasi harus berupa angka.',
            'payment_method.required' => 'Metode pembayaran harus dipilih.',
        ];
    }
}
