<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class CreateThreadTest extends TestCase
{
	/** @test */
	public function guest_may_not_create_threads()
	{
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

		$this->post('/threads', [])
            ->assertRedirect('/login');
	}

	/** @test */
    public function a_user_can_create_new_thread_forum()
    {
    	$this->signIn();

    	$thread = make(Thread::class);

    	$this->post('/threads', $thread->toArray());

    	$this->get($thread->path())
    		->assertSee($thread->title)
    		->assertSee($thread->body);
    }
}
