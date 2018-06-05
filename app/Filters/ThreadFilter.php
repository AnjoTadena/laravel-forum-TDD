<?php

namespace App\Filters;

use App\User;
use App\Contracts\FilterContract;

class ThreadFilter extends FilterContract
{
	protected $filters = ['by', 'popular'];

	protected function by($name)
	{
		$user = User::where('name', $name)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
	}

	protected function popular()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}
