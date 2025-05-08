<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignDonasiAdminRequest extends FormRequest
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
            //
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'thumbnail' => 'required|image|max:2048',
            'status' => 'required|in:aktif,selesai,ditutup',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul campaign harus diisi',
            'description.required' => 'Deskripsi campaign harus diisi',
            'target_amount.required' => 'Target amount harus diisi',
            'start_date.required' => 'Tanggal mulai harus diisi',
            'end_date.required' => 'Tanggal akhir harus diisi',
            'thumbnail.required' => 'Thumbnail harus diisi',
            'status.required' => 'Status harus diisi',
        ];
    }
}
