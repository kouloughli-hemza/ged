<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Kouloughli\User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => '$2y$10$A2A/2IIP.jsLzIiAPr.enuzxzRWzIzLWifqNU33PWPBGx6mkJFz72', // 123123123
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'avatar' => null,
        'address' => $faker->address,
        'country_id' => function () use ($faker) {
            return $faker->randomElement(Kouloughli\Country::pluck('id')->toArray());
        },
        'role_id' => function () {
            return factory(\Kouloughli\Role::class)->create()->id;
        },
        'status' => Kouloughli\Support\Enum\UserStatus::ACTIVE,
        'birthday' => $faker->date(),
        'email_verified_at' => (string) now()
    ];
});
