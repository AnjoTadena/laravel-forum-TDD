<?php

use Faker\Generator as Faker;

// $table->string('title');
// $table->text('body');

// $table->unsignedInteger('user_id');
$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph(3),
        'user_id' => function () {
        	return factory(\App\User::class)->create()->id;
        },
        'channel_id' => function () {
        	return factory(\App\Channel::class)->create()->id;
        }
    ];
});
