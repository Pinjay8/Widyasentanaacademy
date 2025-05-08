<?php

namespace App\Http\Controllers;

use App\Models\Campaigns;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //

    public function index()
    {
        $campaigns = Campaigns::with('admin')->latest()->take(3)->get();
        $donations = Donation::with('campaigns')->latest()->get();

        $today = Carbon::today();

        foreach ($campaigns as $campaign) {
            $start = Carbon::parse($campaign->start_date);
            $end = Carbon::parse($campaign->end_date);

            // Hitung sisa hari jika campaign sedang aktif
            if ($today->between($start, $end)) {
                $campaign->is_active = true;

                if ($today->isSameDay($end)) {
                    $campaign->days_duration = 0;
                    $campaign->label = __('messages.last_day');
                } else {
                    $campaign->days_duration = $today->diffInDays($end) + 1;
                    $campaign->label = $campaign->days_duration . ' ' . __('messages.days');
                }
            } else {
                $campaign->is_active = false;
                $campaign->days_duration = 0;
                $campaign->label = __('messages.finished');
            }
        }

        return view('index', compact('campaigns', 'donations'));
    }

    public function indexDonasi(Request $request)
    {
        $query = Campaigns::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
            $query->orWhere('description', 'like', '%' . $request->search . '%');
            $query->orWhere('target_amount', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'highest':
                    $query->orderBy('target_amount', 'desc');
                    break;
                case 'lowest':
                    $query->orderBy('target_amount', 'asc');
                    break;
            }
        } else {
            $query->latest();
        }

        // Ambil hasil query
        $campaigns = $query->paginate(8)->withQueryString();

        // Hitung durasi hari untuk masing-masing campaign
        $today = Carbon::today();

        foreach ($campaigns as $campaign) {
            $start = Carbon::parse($campaign->start_date);
            $end = Carbon::parse($campaign->end_date);

            // Hitung sisa hari jika campaign sedang aktif
            if ($today->between($start, $end)) {
                $campaign->is_active = true;

                if ($today->isSameDay($end)) {
                    $campaign->days_duration = 0;
                    $campaign->label = __('messages.last_day');
                } else {
                    $campaign->days_duration = $today->diffInDays($end) + 1;
                    $campaign->label = $campaign->days_duration . ' ' . __('messages.days');
                }
            } else {
                $campaign->is_active = false;
                $campaign->days_duration = 0;
                $campaign->label = __('messages.finished');
            }
        }

        return view('pages.donasi', compact('campaigns'));
    }

    public function showDonasi($id)
    {
        $campaign = Campaigns::with('admin')->where('slug', $id)->firstOrFail();
        $donations = Donation::with('campaigns')->where('campaign_id', $campaign->id)->latest()->get();
        $countDonations = Donation::where('campaign_id', $campaign->id)->count();
        $campaigns = Campaigns::with('admin')->latest()->take(3)->get();

        $today = Carbon::today();

        foreach ($campaigns as $campaign) {
            $start = Carbon::parse($campaign->start_date);
            $end = Carbon::parse($campaign->end_date);

            // Hitung sisa hari jika campaign sedang aktif
            if ($today->between($start, $end)) {
                $campaign->is_active = true;

                if ($today->isSameDay($end)) {
                    $campaign->days_duration = 0;
                    $campaign->label = __('messages.last_day');
                } else {
                    $campaign->days_duration = $today->diffInDays($end) + 1;
                    $campaign->label = $campaign->days_duration . ' ' . __('messages.days');
                }
            } else {
                $campaign->is_active = false;
                $campaign->days_duration = 0;
                $campaign->label = __('messages.finished');
            }
        }


        return view('pages.campaign.detail_campaign', compact('campaign', 'donations', 'countDonations', 'campaigns'));
    }


    public function indexDonatur()
    {
        return view('pages.donatur');
    }
}
