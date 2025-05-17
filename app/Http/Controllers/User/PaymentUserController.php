<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentUserRequest;
use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class PaymentUserController extends Controller
{
    public function index()
    {
        return view('pages.user.payments.index');
    }

    public function showPayment()
    {
        $payments = Payment::whereHas('donations', function ($query) {
            $query->where('user_id', Auth::guard('user')->id());
        })
            ->with('donations') // opsional, agar eager load
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.user.payment.index', compact('payments'));
    }


    public function store(PaymentUserRequest $request)
    {
        $credential = $request->validated();

        $payment = Payment::where('donation_id', $request->donation_id)->firstOrFail();

        if ($request->hasFile("history_payment")) {
            $imagePath = $request->file("history_payment")->store("img");
            $dataNews["history_payment"] = $imagePath;
        }

        $payment->update([
            "history_payment" => $imagePath,
        ]);

        $user = Auth::guard('user')->user();

        $donationTitle = $payment->donations->campaigns->title;
        $amount = number_format($payment->donations->amount, 0, ',', '.'); // jika ingin menambahkan jumlah
        $userName = $user->name;
        $userEmail = $user->email;

        $emailBody = "
        Donasi Baru Telah Diterima!

        Detail Donatur:
        Nama  : {$userName}
        Email : {$userEmail}

        Kampanye: {$donationTitle}
        Jumlah  : Rp {$amount}

        Terima kasih telah berdonasi 🙏
        ";

        // Kirim email ke admin
        Mail::raw($emailBody, function ($message) use ($userEmail, $userName) {
            $message->from($userEmail, $userName); // email donatur
            $message->to('widyasentana.academy@gmail.com'); // email admin
            $message->subject('✅ Konfirmasi Pembayaran Donasi');
            $message->replyTo($userEmail, $userName);
        });


        return redirect()->route("home")->with("success", "Terima kasih telah melakukan pembayaran");
    }

    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $donation = Donation::findOrFail($id);
        return view('pages.user.payments.index', compact('donation'));
    }
}
