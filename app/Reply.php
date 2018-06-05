<?php

namespace App;

use App\User;
use App\Favorite;
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

    public function favorites()
    {
    	return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
    	$attributes = ['user_id' => auth()->id()];

    	if ($this->favorites()->where($attributes)->exists()) return;

    	return $this->favorites()->create($attributes);	
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
}

