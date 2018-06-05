<?php

use App\Reply;
use App\Thread;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('users')->truncate();
        DB::table('channels')->truncate();
        DB::table('replies')->truncate();
        DB::table('threads')->truncate();

        factory(Thread::class, 1500)
        	->create()
        	->each(function ($thread) {
        		factory(Reply::class, 5)->create(['thread_id' => $thread->id]);
        	});


        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
