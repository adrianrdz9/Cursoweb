<?php

use Faker\Generator as Faker;

$factory->define(App\Assignment::class, function (Faker $faker) {
    $moduleIds = App\Module::all();

    foreach ($moduleIds as $i => $module) {
        $moduleIds[$i] = $module->id;
    }

    return [
        'deadline' => $faker->dateTimeInInterval('now', '+ 15 days'),
        'title' => $faker->catchPhrase(),
        'description' => $faker->text(230),
        'example' => '',
        'type' => $faker->randomElement(['Tarea', 'Proyecto', 'Ejercicio']),
        'module_id' => $faker->randomElement($moduleIds)
    ];
});