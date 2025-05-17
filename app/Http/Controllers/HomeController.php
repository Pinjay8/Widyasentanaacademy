<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Campaigns;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //

    public function index()
    {
        $campaigns = Campaigns::with('admin')
            ->where('end_date', '>=', Carbon::now())
            ->latest()
            ->take(3)
            ->get();
        $donations = Donation::with('campaigns')->latest()->get();

        $today = Carbon::today();

        foreach ($campaigns as $item) {
            $start = Carbon::parse($item->start_date);
            $end = Carbon::parse($item->end_date);

            if ($today->between($start, $end)) {
                $item->is_active = true;

                if ($today->isSameDay($end)) {
                    $item->days_duration = 0;
                    $item->label = __('messages.last_day');
                } else {
                    $item->days_duration = $today->diffInDays($end);
                    $item->label = $item->days_duration . ' ' . __('messages.days');
                }
            } elseif ($today->lt($start)) {
                // Belum dimulai
                $item->is_active = false;
                $item->days_duration = $today->diffInDays($start);
                $item->label = __('messages.upcoming') . ' (' . $item->days_duration . ' ' . __('messages.days') . ')';
            } else {
                // Sudah selesai
                $item->is_active = false;
                $item->days_duration = 0;
                $item->label = __('messages.finished');
            }
        }

        $banners = Banner::latest()->get();

        return view('index', compact('campaigns', 'donations', 'banners'));
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
                case 'still_active':
                    $query->where('end_date', '>=', Carbon::now());
                    break;
                case 'finished':
                    $query->where('end_date', '<', Carbon::now());
                    break;
            }
        } else {
            $query->latest();
        }

        // Ambil hasil query
        $campaigns = $query->paginate(8)->withQueryString();

        // Hitung durasi hari untuk masing-masing campaign
        $today = Carbon::today();

        foreach ($campaigns as $item) {
            $start = Carbon::parse($item->start_date);
            $end = Carbon::parse($item->end_date);

            if ($today->between($start, $end)) {
                $item->is_active = true;

                if ($today->isSameDay($end)) {
                    $item->days_duration = 0;
                    $item->label = __('messages.last_day');
                } else {
                    $item->days_duration = $today->diffInDays($end);
                    $item->label = $item->days_duration . ' ' . __('messages.days');
                }
            } elseif ($today->lt($start)) {
                // Belum dimulai
                $item->is_active = false;
                $item->days_duration = $today->diffInDays($start);
                $item->label = __('messages.upcoming') . ' (' . $item->days_duration . ' ' . __('messages.days') . ')';
            } else {
                // Sudah selesai
                $item->is_active = false;
                $item->days_duration = 0;
                $item->label = __('messages.finished');
            }
        }

        return view('pages.donasi', compact('campaigns'));
    }

    public function showDonasi($id)
    {
        $campaign = Campaigns::with('admin')->where('slug', $id)->firstOrFail();
        $donations = Donation::with('campaigns')->where('campaign_id', $campaign->id)->where('status', 'success')->latest()->get();
        $countDonations = Donation::where('campaign_id', $campaign->id)->where('status', 'success')->count();
        $campaigns = Campaigns::with('admin')->where('end_date', '>=', Carbon::now())->latest()->take(3)->get();

        $today = Carbon::today();

        // Hitung days_duration untuk campaign yang sedang dilihat
        $start = Carbon::parse($campaign->start_date);
        $end = Carbon::parse($campaign->end_date);

        if ($today->between($start, $end)) {
            $campaign->is_active = true;

            if ($today->isSameDay($end)) {
                $campaign->days_duration = 0;
                $campaign->label = __('messages.last_day');
            } else {
                $campaign->days_duration = $today->diffInDays($end);
                $campaign->label = $campaign->days_duration . ' ' . __('messages.days');
            }
        } else {
            $campaign->is_active = false;
            $campaign->days_duration = 0;
            $campaign->label = __('messages.finished');
        }

        foreach ($campaigns as $item) {
            $start = Carbon::parse($item->start_date);
            $end = Carbon::parse($item->end_date);

            if ($today->between($start, $end)) {
                $item->is_active = true;

                if ($today->isSameDay($end)) {
                    $item->days_duration = 0;
                    $item->label = __('messages.last_day');
                } else {
                    $item->days_duration = $today->diffInDays($end);
                    $item->label = $item->days_duration . ' ' . __('messages.days');
                }
            } elseif ($today->lt($start)) {
                $item->is_active = false;
                $item->days_duration = $today->diffInDays($start);
                $item->label = __('messages.upcoming') . ' (' . $item->days_duration . ' ' . __('messages.days') . ')';
            } else {
                $item->is_active = false;
                $item->days_duration = 0;
                $item->label = __('messages.finished');
            }
        }

        return view('pages.campaign.detail_campaign', compact('campaign', 'donations', 'countDonations', 'campaigns'));
    }


    public function indexDonatur()
    {
        return view('pages.donatur');
    }
}
