<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentAdminController extends Controller
{

    public function index(Request $request)
    {
        $query = Payment::with('donations')->latest();

        // Filter berdasarkan status jika tersedia
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->get();

        return view('pages.admin.payments.index', compact('payments'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'success',
        ]);

        $donation = $payment->donations;

        $donation->update([
            'status' => 'success',
        ]);

        $campaign = $donation->campaigns; // pastikan relasi 'campaign' tersedia di model Donation
        $campaign->collected_amount += $donation->amount;
        $campaign->save();

        return redirect()->route('paymentsadmin.index')->with('success', 'Status Pembayaran berhasil diubah');
    }
}
