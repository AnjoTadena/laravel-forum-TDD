<?php

namespace App;

use App\User;
use App\Reply;
use App\Channel;
use App\BaseModel;

class Thread extends BaseModel
{
    /**
     * Creator Name Attribute
     * @return string
     */
	public function getCreatorNameAttribute()
    {
    	return $this->creator->name;
    }

    /**
     * Thread Replies
     * @return \App\Reply Collection
     */
    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    /**
     * Creator
     * @return \App\User
     */
    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * URL Path
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }
    
    /**
     * Thread add reply
     * @param \App\Reply
     */
    public function addReply($reply)
    {
    	$this->replies()->create($reply);
    }

    /**
     * Thread belongs to a channel
     * @return \App\Channel
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}