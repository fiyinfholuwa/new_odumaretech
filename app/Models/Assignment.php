<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    
    public function course_name()
    {
      return $this->hasOne(Course::class, 'id', 'course_id');
    }
    public function cohort_name()
    {
      return $this->hasOne(Cohort::class, 'id', 'cohort_id');
    }
}
