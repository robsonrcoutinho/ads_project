<?php

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

$factory->define(adsproject\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(adsproject\Disciplina::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->sentence(2),
        'nome' => $faker->sentence(20),
        'carga_horaria' => $faker->numberBetween(1,1000),
        'ementa' => $faker->sentence(20),
        'ativa' => $faker->boolean(true),

    ];
});

$factory->define(adsproject\Professor::class, function (Faker\Generator $faker) {
    return [
        'matricula' => $faker->sentence(2),
        'nome' => $faker->sentence(20),
        'ativo' => $faker->boolean(true),
        'curriculo' => $faker->sentence(20),
    ];
});

$factory->define(adsproject\Semestre::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->sentence(2),
        'inicio' => $faker->date(4),
        'termino' => $faker->date(4),


    ];
});


$factory->define(adsproject\Avaliacao::class, function (Faker\Generator $faker) {
    return [
        'semestre' => $faker->sentence(2),
        'inicio' => $faker->date(4),
        'termino' => $faker->date(4),
        'semestre_id' => 1,

    ];
});


$factory->define(adsproject\Pergunta::class, function (Faker\Generator $faker) {
    return [
        'enunciado' => $faker->sentence(20),
        'pergunta_fechada' => $faker->boolean(true),

    ];
});

$factory->define(adsproject\Resposta::class, function (Faker\Generator $faker) {
    return [
        'campo_resposta' => $faker->sentence(20),
        'pergunta_id' => 1,
    ];
});

$factory->define(adsproject\OpcaoResposta::class, function (Faker\Generator $faker) {
    return [
        'resposta_opcao_id' => $faker->sentence(20),
        'pergunta_id' => 1,
    ];
});



