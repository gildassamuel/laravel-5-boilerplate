<?php

use Faker\Generator;
use App\Models\Auth\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
	static $password;

	return [
		'first_name'        => $faker->firstName,
		'last_name'         => $faker->lastName,
		'email'             => $faker->safeEmail,
		'password'          => $password ?: $password = bcrypt('secret'),
		'remember_token'    => str_random(10),
		'confirmation_code' => md5(uniqid(mt_rand(), true)),
	];
});

$factory->state(User::class, 'active', function () {
	return [
		'status' => 1,
	];
});

$factory->state(User::class, 'inactive', function () {
	return [
		'status' => 0,
	];
});

$factory->state(User::class, 'confirmed', function () {
	return [
		'confirmed' => 1,
	];
});

$factory->state(User::class, 'unconfirmed', function () {
	return [
		'confirmed' => 0,
	];
});
