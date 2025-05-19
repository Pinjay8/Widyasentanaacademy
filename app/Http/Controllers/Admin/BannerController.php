<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('pages.admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('pages.admin.banner.create');
    }

    public function store(BannerRequest $request)
    {
        $credentials = $request->validated();

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path')->store('img', 'public');
            $credentials['image_path'] = $image;
        }

        Banner::create($credentials);

        return redirect()->route('banners.index')->with('success', 'Berhasil menambahkan banner');
    }
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('pages.admin.banner.edit', compact('banner'));
    }

    public function update(BannerRequest $request, $id)
    {
        $credentials = $request->validated();
        $banner = Banner::findOrFail($id);

        $bannerPath = $banner->image_path;

        if ($request->hasFile('image_path')) {
            // Hapus file lama jika ada
            if ($bannerPath) {
                Storage::delete($bannerPath);
            }
            // Simpan file baru
            $credentials['image_path'] = $request->file('image_path')->store('img', 'public');
        }

        $banner->update($credentials);

        return redirect()->route('banners.index')->with('success', 'Berhasil mengupdate banner');
    }

    public function destroy($id)
    {

        $banner = Banner::findOrFail($id);

        if ($banner) {
            $imagePath = $banner->image_path;
            // Hapus file gambar dari storage
            if ($imagePath) {
                Storage::delete($imagePath);
            }
        }
        // Hapus banner dari database
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Berhasil menghapus banner');
    }
}
