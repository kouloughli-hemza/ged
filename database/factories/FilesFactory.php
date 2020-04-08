<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Kouloughli\File::class, function (Faker $faker) {

    return [
        'expiditeur' => $faker->paragraph(1),
        'destinataire' => $faker->randomLetter,
        'objet' => $faker->paragraph(1),
        'num_text' => $faker->randomDigit,
        'num_enrg' => $faker->randomDigit,
        'sig_ext' => $faker->firstName,
        'sig_int' => $faker->lastName,
        'file_name' => '04_2020_1586194926.pdf',
        'file_size' => '2000',
        'file_path' => '/opt/lampp/htdocs/ged/storage/app/public/ged//zaki/04_2020_1586132417.pdf',
        'mime' => 'application/pdf',
        'ref_user' => 3,
        'importance' => \Kouloughli\Support\Enum\FileImportance::URGENT,
        'nombre_page' => 2,
        'communication_a' => $faker->randomLetter,
        'date_arrivee' => $faker->date(),
        'heur_arrivee' => $faker->time()
    ];
});
