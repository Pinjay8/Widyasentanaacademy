<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaigns extends Model
{
    //
    protected $fillable = [
        'admin_id',
        'title',
        'slug',
        'description',
        'target_amount',
        'collected_amount',
        'start_date',
        'end_date',
        'thumbnail',
        'status',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class, 'campaign_id');
    }

    // public function getCollectedAmountAttribute()
    // {
    //     return $this->donations->sum('amount');
    // }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function thumbnail()
    {
        return Storage::url($this->thumbnail);
    }
}
