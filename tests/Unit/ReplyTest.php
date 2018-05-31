<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    /** @test */
    public function it_has_a_owner()
    {
    	$reply = create(Reply::class);

    	$this->assertInstanceOf(User::class, $reply->owner);
    }

    /** @test */
    public function a_reply_body_is_required()
    {
    	$this->withExceptionHandling()->signIn();

		 $thread = create(Thread::class);
		 $reply = make(Reply::class, ['body' => null]);

		 $this->post(
		 	$thread->path() . "/replies", 
		 	$reply->toArray())
		 	->assertSessionHasErrors('body');
    }
}
