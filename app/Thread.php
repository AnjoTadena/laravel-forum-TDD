<?php

namespace App;

use App\User;
use App\Reply;
use App\BaseModel;

class Thread extends BaseModel
{
	public function getCreatorNameAttribute()
    {
    	return $this->creator->name;
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return '/threads/' . $this->id;
    }
 
    public function addReply($reply)
    {
    	$this->replies()->create($reply);
    }
}