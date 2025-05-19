<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonasiUserRequest;
use App\Models\Campaigns;
use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DonasiUserController extends Controller
{

    public function index()
    {
        $donations = Donation::with('campaigns')
            ->where('user_id', Auth::guard('user')->id())
            ->latest() // sama dengan orderBy('created_at', 'desc')
            ->get();

        return view('pages.user.donation.index', compact('donations'));
    }

    public function store(DonasiUserRequest $request)
    {
        $credential = $request->validated();

        // Dekripsi campaign_id

        $donation = Donation::create([
            'campaign_id' => $request->campaign_id,
            'user_id' => Auth::guard('user')->id() ?? Auth::guard('admin')->id(),
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'messages' => $request->messages,
            'status' => 'pending',
        ]);

        Payment::create([
            'donation_id' => $donation->id,
            'payment_date' => now(),
            'history_payment' => '',
            'status' => 'pending',
            'expires_at' => Carbon::now()->addDays(1)
        ]);

        return redirect()->route('payments.showForm', Crypt::encrypt($donation->id))->with('success', 'Donasi berhasil dilakukan.');
    }
}
