<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];
    public function cat()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function instructor_name()
    {
        return $this->hasOne(User::class, 'id', 'instructor');
    }

    public function cohort()
    {
        return $this->hasOne(Cohort::class, 'id', 'cohort');
    }
}
