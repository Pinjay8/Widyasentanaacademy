<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        $donations = Donation::where('user_id', Auth::guard('user')->id())->latest()->take(5)->get();
        $countDonations = Donation::where('user_id', Auth::guard('user')->id())->count();
        $payments = Payment::whereHas('donations', function ($query) {
            $query->where('user_id', Auth::guard('user')->id());
        })
            ->with('donations') // opsional, agar eager load
            ->latest()
            ->take(5)
            ->get();

        // Total donasi dan pembayaran
        $totalDonasi = $donations->where('status', 'success')->sum('amount');
        $totalPembayaran = $payments->sum('amount');

        // Donasi terbaru
        $latestDonation = $donations->first();

        return view('pages.user.dashboard', compact('donations', 'payments', 'totalDonasi', 'totalPembayaran', 'latestDonation', 'countDonations'));
    }
}
