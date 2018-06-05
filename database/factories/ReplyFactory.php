<?php

use Faker\Generator as Faker;

// $table->unsignedInteger('thread_id');
// $table->unsignedInteger('user_id');
// $table->text('body');
$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function () {
        	return factory(\App\Thread::class)->create()->id;
        },
        'user_id' => function () {
        	return factory(\App\User::class)->create()->id;
        },
        'body' => $faker->paragraph(3)
    ];
});
