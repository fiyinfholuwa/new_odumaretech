<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function course_name()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

}
