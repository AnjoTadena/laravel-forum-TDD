<?php

namespace App\Traits;

use App\Favorite;

trait Favoritable
{
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
        return $this->favorites->contains('user_id', auth()->id());
    }

    public function getFavoriteCountAttribute()
    {
		return $this->favorites->count();  	
    }
}