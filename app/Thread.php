<?php

namespace App;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }
}
