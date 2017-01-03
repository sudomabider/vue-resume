<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Entities\Experience::class, function (Faker\Generator $faker) {
    return [
        'employer' => $faker->company,
        'title' => $faker->jobTitle,
        'start' => $start = $faker->dateTimeThisCentury,
        'end' => Carbon\Carbon::instance($start)->addMonths($faker->randomNumber(2))
    ];
});

$factory->define(\App\Entities\Highlight::class, function(Faker\Generator $faker) {
    return [
        'content' => $faker->sentence
    ];
});

$factory->define(\App\Entities\Skill::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'color' => $faker->hexColor
    ];
});