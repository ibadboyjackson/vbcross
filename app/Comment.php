<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Comment extends Model
{
    use Likeable, HasTrixRichText;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
