<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];

});

$factory->define(\App\Models\Admin\Group::class, function (Faker $faker) {
    $privArr = [];
    foreach (\App\Helper\Standarts::$adminModules as $module) {
        if (isset($module['child'])) {
            foreach ($module['child'] as $m) {
                $privArr[$m['route']] = 3;
            }
        } else {
            $privArr[$module['route']] = 3;
        }
    }
    return [
        'group_name' => "Admin",
        'aviable_modules' => json_encode($privArr),
    ];
});
