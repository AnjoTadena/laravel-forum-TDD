<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;
// use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
	use DatabaseMigrations;


	/** @test */
    public function unauthenticated_user_may_not_add_reply()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');

    	// And an existing thread
    	$thread = factory(Thread::class)->create();
    	
    	// When the user adss a reply to the thread
    	$this->post($thread->path() . '/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
    	// Given we have authenticated user
    	$this->signIn($user = factory(User::class)->create());

    	// And an existing thread
    	$thread = factory(Thread::class)->create();

    	$reply = factory(Reply::class)->make();

    	// When the user adss a reply to the thread
    	$this->post($thread->path() . '/replies', $reply->toArray());

    	// Then their reply should be visible on the page.
    	$this->get($thread->path())
    		->assertSee($reply->body);
    }
}
