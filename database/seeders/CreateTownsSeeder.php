<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateTownsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towns = [
            ['name' => 'ASENTAMIENTOS'],
            ['name' => 'BARRIOS DE JOJUTLA CENTRO'],
            ['name' => 'CHISCO'],
            ['name' => 'HIGUERON'],
            ['name' => 'JICARERO'],
            ['name' => 'JOJUTLA CENTRO'],
            ['name' => 'LAZARO CARDENAS'],
            ['name' => 'PANCHIMALCO'],
            ['name' => 'PEDRO AMARO'],
            ['name' => 'TEHUIXTLA '],
            ['name' => 'TEQUESQUITENGO'],
            ['name' => 'TLATENCHI'],
        ];

        foreach ($towns as $town) {
            $new_town = Town::Create([
                'name' => $town['name'],
            ]);

            $new_town->save();
        }
    }
}
