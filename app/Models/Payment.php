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

    // public function getStatusAttribute($value)
    // {
    //     return $value === 'pending' ? 'Pending' : ($value === 'success' ? 'Success' : 'Failed');
    // }

    // public function getPaymentDateAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('d-m-Y');
    // }
    // public function getExpiresAtAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    // }
}
