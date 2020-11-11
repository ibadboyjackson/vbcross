<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'user_chat_messages';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_messages' , 'message_id');
    }
}
