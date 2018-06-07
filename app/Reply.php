<?php

namespace App;

use App\User;
use App\Favorite;
use App\BaseModel;
use App\Traits\Favoritable;

class Reply extends BaseModel
{
    use Favoritable;

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function getOwnerNameAttribute()
    {
    	return $this->owner->name;
    }
}

