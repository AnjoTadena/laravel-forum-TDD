<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    /** @test */
    public function it_has_a_owner()
    {
    	$reply = create(Reply::class);

    	$this->assertInstanceOf(User::class, $reply->owner);
    }
}
