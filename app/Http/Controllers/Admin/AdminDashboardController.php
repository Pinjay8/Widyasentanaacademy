<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Campaigns;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{

    public function index()
    {
        // Mengambil total donasi
        $totalDonasi = Donation::where('status', 'success')->sum('amount');
        $countDonasi = Donation::count();

        // Mengambil total pembayaran yang berhasil
        $totalPembayaran = DB::table('payments')
            ->join('donations', 'payments.donation_id', '=', 'donations.id')
            ->where('payments.status', 'success')
            ->sum('donations.amount');

        $countPembayaran = DB::table('payments')
            ->where('payments.status', 'success')
            ->count();

        // Mengambil total campaign yang aktif
        $totalCampaign = Campaigns::count();

        // Mengambil 5 campaign terbaru
        $campaigns = Campaigns::latest()->take(5)->get();

        // Data untuk chart: total donasi per bulan
        $donasiPerBulan = Donation::selectRaw('MONTH(created_at) as month, SUM(amount) as total_amount')
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 'success')
            ->get();

        $months = $donasiPerBulan->pluck('month');
        $totalAmount = $donasiPerBulan->pluck('total_amount');

        // Mengirimkan data ke view dashboard
        return view('pages.admin.dashboard', compact('totalDonasi', 'totalPembayaran', 'totalCampaign', 'campaigns', 'months', 'totalAmount', 'countDonasi', 'countPembayaran'));
    }
}
