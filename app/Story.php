<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Story extends Model
{
    use HasTrixRichText;

    protected $guarded = [];
}
