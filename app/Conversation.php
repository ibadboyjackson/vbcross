<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function memberOne()
    {
        return $this->belongsTo(User::class, 'member_one');
    }

    public function memberTwo()
    {
        return $this->belongsTo(User::class, 'member_two');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'conversation_id');
    }
}
