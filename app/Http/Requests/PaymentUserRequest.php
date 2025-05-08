<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUserRequest extends FormRequest
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
            "history_payment" => "required|mimes:jpg,jpeg,png|max:5000",
        ];
    }

    public function messages(): array
    {
        return [
            "history_payment.required" => "Bukti pembayaran harus diisi.",
            "history_payment.mimes" => "Bukti Pembayaran harus berupa gambar dengan format jpg, jpeg, png.",
            "history_payment.max" => "Ukuran Bukti Pembayaran tidak boleh lebih dari 5MB.",
        ];
    }
}
