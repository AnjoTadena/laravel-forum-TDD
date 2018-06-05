<?php

namespace Tests\Feature;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function a_guest_cannot_favorite_a_reply()
    {
    	$this->withExceptionHandling()
    	// Favorite any replies
    		->post('replies/1/favorites')
    	    ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_a_reply()
    {
    	$this->signIn();

    	$reply = create(Reply::class);

    	$this->post("/replies/{$reply->id}/favorites");
    	
    	$this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_favorite_a_reply_once()
    {
    	$this->signIn();

    	$reply = create(Reply::class);

    	try {
    		$this->post("/replies/{$reply->id}/favorites");
	    	$this->post("/replies/{$reply->id}/favorites");
    	} catch (\Exception $e) {
    		$this->fail('Did not expect to insert same record.');
    	}
    	
    	$this->assertCount(1, $reply->favorites);
    }

}
