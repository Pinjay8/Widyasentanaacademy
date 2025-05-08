<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonasiAdminController extends Controller
{

    public function index()
    {
        $donations = Donation::with('campaigns')->latest()->get();
        return view('pages.admin.donation.index', compact('donations'));
    }
}
