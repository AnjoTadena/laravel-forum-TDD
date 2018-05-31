<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use App\Channel;
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

		$this->post("/threads", [])
            ->assertRedirect('/login');
	}

	/** @test */
    public function a_user_can_create_new_thread_forum()
    {
    	$this->signIn();

    	$thread = make(Thread::class);

        $response = $this->post("/threads", $thread->toArray());

    	$this->get($response->headers->get('Location'))
    		->assertSee($thread->title)
    		->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_title_is_required()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_body_is_required()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_channel_id_is_required()
    {
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function a_thread_user_id_is_required()
    {
        $this->publishThread(['user_id' => null])
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function a_thread_channel_id_must_be_valid()
    {
        factory(Channel::class, 2)->create();

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($override = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make(Thread::class, $override);
        // dd($thread->channel->slug);
        return $this->post("/threads", $thread->toArray());
    }
}
