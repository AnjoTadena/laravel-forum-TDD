<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_use_can_view_a_single_thread()
    {
        $this->get(route('threads.show', $this->thread->id))
            ->assertSee($this->thread->title);        
    }

    /** @test */
    function a_user_can_view_replies_associeted_with_the_thread()
    {
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);

        $this->get(route('threads.show', $this->thread->id))
            ->assertSee($reply->body);
    }

    /** @test */
    function a_user_can_view_reply_owner()
    {
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);

        $this->get(route('threads.show', $this->thread->id))
            ->assertSee($reply->owner->name);
    }
}
