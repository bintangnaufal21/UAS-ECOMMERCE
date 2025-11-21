<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $fillable = [
        'banner_title',
        'banner_desc',
        'banner_image',
    ];
}
