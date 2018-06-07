<?php

namespace App;

use App\User;
use App\Reply;
use App\Channel;
use App\BaseModel;
use App\Scopes\ThreadReplyCountScope;

class Thread extends BaseModel
{

    protected $with = ['creator'];

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope(new ThreadReplyCountScope);
    }

    /**
     * Creator Name Attribute
     * @return string
     */
	public function getCreatorNameAttributes()
    {
    	return $this->creator->name;
    }

    /**
     * Thread Replies
     * @return \App\Reply Collection
     */
    public function replies()
    {
    	return $this->hasMany(Reply::class)
                    ->withCount('favorites');
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

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }
}