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

        $thread = create(Thread::class);

        $this->get('/threads/create')
            ->assertRedirect('/login');

		$this->post("/threads/{$thread->channel->name}", [])
            ->assertRedirect('/login');
	}

	/** @test */
    public function a_user_can_create_new_thread_forum()
    {
    	$this->signIn();

    	$thread = make(Thread::class);

        $response = $this->post("/threads/{$thread->channel->slug}", $thread->toArray());

    	$this->get($response->headers->get('Location'))
    		->assertSee($thread->title)
    		->assertSee($thread->body);
    }
}
