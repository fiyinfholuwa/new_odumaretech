<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionForum extends Model
{
    protected $guarded = ['id'];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question_replies() {
        return $this->hasMany(QuestionReply::class);
    }

}
