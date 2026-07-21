<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitAssignment extends Model
{
    public function course_name()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function assignment_name()
    {
        return $this->belongsTo(Assignment::class, 'assessment_id');
    }
}
