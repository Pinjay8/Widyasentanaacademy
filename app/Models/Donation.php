<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    protected $fillable = [
        'campaign_id',
        'user_id',
        'amount',
        'payment_method',
        'messages',
        'status',
    ];
    public function campaigns()
    {
        return $this->belongsTo(Campaigns::class, 'campaign_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'donation_id');
    }
}
