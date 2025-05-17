<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{

    protected $fillable = [
        'image_path',
    ];

    public function imagePath()
    {
        return Storage::url($this->image_path);
    }
}
