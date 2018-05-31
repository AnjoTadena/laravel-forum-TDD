<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class ParticipateInForumTest extends TestCase
{
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

	/** @test */
    public function unauthenticated_user_may_not_add_reply()
    {
        $this->withExceptionHandling()
            ->post($this->thread->path() . '/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
    	// Given we have authenticated user
    	$this->signIn($user = create(User::class));

    	$reply = make(Reply::class);

    	// When the user adss a reply to the thread
    	$this->post($this->thread->path() . '/replies', $reply->toArray());

    	// Then their reply should be visible on the page.
    	$this->get($this->thread->path())
    		->assertSee($reply->body);
    }
}
    