<?php

namespace App;

use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Musonza\Chat\Traits\Messageable;
use Overtrue\LaravelLike\Traits\Liker;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements BannableContract
{
    use Notifiable, HasRoles, Bannable, Liker, Messageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function userQAs()
    {
        return $this->hasMany(UserQA::class, 'user_id');
    }

    public function userAvatar()
    {
        return $this->hasOne(UserAvatar::class, 'user_id');
    }

    public function messages()
    {
        return $this->belongsToMany(ChatMessage::class, 'user_messages', 'user_id' , 'message_id');
    }

    public function userProfileText()
    {
        return $this->hasOne(UserProfileText::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function vii()
    {
        return $this->hasOne(UserVii::class, 'user_id');
    }
}
