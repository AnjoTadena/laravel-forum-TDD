<?php

namespace Tests\Unit;

use Test;
use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ThreadTest extends TestCase
{
	protected $thread;

	function setUp()
	{
		parent::setUp();

    	$this->thread = create(Thread::class);
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

    /** @test */
    public function a_guest_cannot_see_create_page()
    {
        $this->withExceptionHandling();

        $thread = create(Thread::class);

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_thread_can_make_string_path()
    {
        $thread = create(Thread::class);

        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }
}
