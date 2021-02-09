<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    $title = $faker->sentence(10);
    $body = $faker->sentence(100);
    return [
        'title' => $title,
        'body' => $body,
        'slug' => str_slug($title),
        'meta_title' => str_limit($title, 55, '...'),
        'meta_description' => str_limit($body, 155, '...'),
    ];
});
