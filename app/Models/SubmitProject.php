<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitProject extends Model
{
    public function course_name()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
