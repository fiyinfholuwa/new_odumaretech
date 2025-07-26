<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'bank_info',
        'status',
    ];

    protected $casts = [
        'bank_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>