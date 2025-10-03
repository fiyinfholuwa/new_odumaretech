<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookieConsent extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'accepted',
        'page',
        'referrer',
        'device_info',
        'session_id'
    ];

    protected $casts = [
        'accepted' => 'boolean',
        'device_info' => 'array',
    ];
}
