<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionReply extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Each reply belongs to a question
     */
    public function question()
    {
        return $this->belongsTo(QuestionForum::class, 'question_id');
    }
}
