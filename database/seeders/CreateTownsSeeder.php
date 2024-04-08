<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
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

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, count($towns));

        // Mensaje de inicio
        $output->writeln('<info>Comenzando la inserción de datos en la tabla Towns...</info>');

        $progressBar->start();

        foreach ($towns as $town) {
            $new_town = Town::Create([
                'name' => $town['name'],
            ]);

            $new_town->save();
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');

        // Mensaje de finalización
        $output->writeln('<info>¡La inserción de datos en la tabla Towns ha finalizado!</info>');
    }
}
