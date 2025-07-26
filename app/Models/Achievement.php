<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title', 'description', 'color', 'icon', 'points', 'target'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
                    ->withPivot('earned', 'current', 'progress', 'earned_at')
                    ->withTimestamps();
    }
}
