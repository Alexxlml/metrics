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
            ["name" => "ALTAVISTA"],
            ["name" => "CHISCO"],
            ["name" => "CONSTITUCION DEL 57"],
            ["name" => "HIGUERON"],
            ["name" => "INDEPENDENCIA"],
            ["name" => "JICARERO"],
            ["name" => "JOJUTLA CENTRO"],
            ["name" => "LAZARO CARDENAS"],
            ["name" => "LOS PILARES"],
            ["name" => "NICOLAS BRAVO"],
            ["name" => "OTRA COLONIA"],
            ["name" => "PANCHIMALCO"],
            ["name" => "PEDRO AMARO"],
            ["name" => "RIO SECO"],
            ["name" => "TEHUIXTLA "],
            ["name" => "TEQUESQUITENGO"],
            ["name" => "TLATENCHI"],
            ["name" => "U. HAB. JOSE MA. MORELOS Y PAVON"],
            ["name" => "VICENTE ARANDA (SAN RAFAEL)"],
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
