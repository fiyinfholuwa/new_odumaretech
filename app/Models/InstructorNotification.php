<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorNotification extends Model
{
    public function course_name()
    {
      return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
