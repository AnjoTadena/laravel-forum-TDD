<?php

namespace App;

use App\Thread;
use Illuminate\Database\Eloquent\Model;

class Channel extends BaseModel
{
	protected $fillable = ['name', 'slug'];

	/**
	 * Channel has many threads
	 * @return Collection of \App\Threads
	 */
	public function threads()
	{
		return $this->hasMany(Thread::class);
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
