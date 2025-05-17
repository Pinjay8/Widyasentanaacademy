<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignDonasiAdminRequest;
use App\Models\Campaigns;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignDonasiController extends Controller
{

    public function index($slug)
    {
        $campaigns = Campaigns::where('slug', $slug)->firstOrFail();
        return view(
            'pages.campaign.index',
            [
                'campaigns' => $campaigns,
            ]
        );
    }

    public function indexDashboard()
    {
        $campaigns = Campaigns::with('donations')->latest()->get();
        return view('pages.admin.campaign.index', compact('campaigns'));
    }

    public function create()
    {
        return view('pages.admin.campaign.create');
    }

    public function store(CampaignDonasiAdminRequest $request)
    {
        $credentials = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('img', 'public');
            $credentials['thumbnail'] = $thumbnail;
        }
        Campaigns::create([
            'admin_id' => auth('admin')->id(),
            'slug' => str()->slug($credentials['title']),
            'title' => $credentials['title'],
            'description' => $credentials['description'],
            'target_amount' => $credentials['target_amount'],
            'collected_amount' => 0,
            'start_date' => $credentials['start_date'],
            'end_date' => $credentials['end_date'],
            'thumbnail' => $credentials['thumbnail'] ?? null,
            'status' => $credentials['status'],
        ]);

        return redirect()->route('campaigns.indexDashboard')->with('success', 'Berhasil menambahkan campaign');
    }

    public function edit(Campaigns $campaign)
    {
        return view('pages.admin.campaign.edit', [
            'campaign' => $campaign,
            'button' => 'Update'
        ]);
    }

    public function update(CampaignDonasiAdminRequest $request, Campaigns $campaign)
    {
        $credentials = $request->validated();

        $thumbnailPath = $campaign->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::delete($thumbnailPath);
            }

            $credentials['thumbnail'] =  $request->file('thumbnail')->store('img', 'public');
        }

        $campaign->update($request->only([
            'title',
            'description',
            'target_amount',
            'start_date',
            'end_date',
            'thumbnail',
            'status'
        ]));

        $campaign->update($credentials);

        return redirect()->route('campaigns.indexDashboard')->with('success', 'Berhasil memperbarui campaign');
    }

    public function destroy($id)
    {
        $campaign = Campaigns::findOrFail($id);

        if ($campaign) {
            $thumbnailPath = $campaign->thumbnail;
            // Hapus file thumbnail dari storage
            Storage::delete($thumbnailPath);
        }
        $campaign->delete();
        return redirect()->route('campaigns.indexDashboard')->with('success', 'Berhasil menghapus campaign');
    }
}
