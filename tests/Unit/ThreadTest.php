<?php

namespace Tests\Unit;

use App\User;
use App\Thread;
use Tests\TestCase;
// use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;

	protected $thread;

	function setUp()
	{
		parent::setUp();

    	$this->thread = factory(Thread::class)->create();
	}

    /** @test */
    public function a_thread_has_replies()
    {
    	$this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
    	$this->assertInstanceOf(User::class, $this->thread->creator);
    }

    /** @test */
    public function is_should_add_reply()
    {
    	$this->thread->addReply([
    		'body' => 'Foo',
    		'user_id' => 1
    	]);

    	$this->assertCount(1, $this->thread->replies);
    }
}
