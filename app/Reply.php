<?php

namespace App;

use App\User;
use App\BaseModel;

class Reply extends BaseModel
{
    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function getOwnerNameAttribute()
    {
    	return $this->owner->name;
    }
}
