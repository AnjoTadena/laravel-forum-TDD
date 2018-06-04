<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use App\Channel;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
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
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);        
    }

    /** @test */
    function a_user_can_view_replies_associeted_with_the_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_user_can_view_reply_owner()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->ownerName);
    }

    /** @test */
    public function a_user_can_filter_a_threads_according_to_channel()
    {
        $channel = create(Channel::class);
        
        $threadInAChannel = create(Thread::class, ['channel_id' => $channel->id]);

        $threadNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInAChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_by_username()
    {
        $this->signIn(create(User::class, ['name' => 'JohnDoe']));

        $threadByJohnDoe = create(Thread::class, ['user_id' => auth()->id()]);

        $threadNotByJohnDoe = create(Thread::class);

        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohnDoe->title)
            ->assertDontSee($threadNotByJohnDoe->title);
    }

    /** @test */
    public function a_use_can_filter_by_popularity()
    {
        // Given we have 4 threads
        // first thread have 5 replies
        $threadWithFiveReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithFiveReplies->id], 5);

        // second thread have 2 replies
        $threadWithTwoReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReplies->id], 2);

        // fourth thread have 4 replies
        $threadWithFourReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithFourReplies->id], 4);

        // we return a json order by popularity
        $responseJson = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([5, 4, 2, 0], array_column($responseJson, 'replies_count'));
    }
}
