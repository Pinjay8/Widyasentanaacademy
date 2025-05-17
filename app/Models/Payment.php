<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    protected $fillable = [
        'donation_id',
        'payment_date',
        'history_payment',
        'status',
        'expires_at',
    ];
    public function donations()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
