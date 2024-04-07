<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $sections = [
            ["number" => "501", "name" => "CUAUHTEMOC"],
            ["number" => "502", "name" => "CUAUHTEMOC"],
            ["number" => "503", "name" => "UNIDAD HABITACIONAL EL HIGUERON"],
            ["number" => "504", "name" => "EMILIANO ZAPATA"],
            ["number" => "505", "name" => "EMILIANO ZAPATA"],
            ["number" => "506", "name" => "CENTRO"],
            ["number" => "507", "name" => "CENTRO"],
            ["number" => "509", "name" => "UNIDAD HABITACIONAL LA PASTRANA"],
            ["number" => "508", "name" => "CENTRO"],
            ["number" => "510", "name" => "DEL BOSQUE"],
            ["number" => "511", "name" => "CENTRO"],
            ["number" => "512", "name" => "CENTRO"],
            ["number" => "513", "name" => "CENTRO, FRACCIONAMIENTO REFORMA"],
            ["number" => "514", "name" => "CENTRO"],
            ["number" => "515", "name" => "CENTRO"],
            ["number" => "516", "name" => "PANCHIMALCO"],
            ["number" => "517", "name" => "UNIDAD HABITACIONAL LAS CAÑAS"],
            ["number" => "518", "name" => "CENTRO TEQUESQUITENGO"],
            ["number" => "519", "name" => "CENTRO TEQUESQUITENGO"],
            ["number" => "520", "name" => "JICARERO"],
            ["number" => "521", "name" => "CONSTITUCION DEL 57"],
            ["number" => "522", "name" => "UNIDAD HABITACIONAL JOSE MARIA MORELOS Y PAVON"],
            ["number" => "523", "name" => "UNIDAD HABITACIONAL JOSE MARIA MORELOS Y PAVON"],
            ["number" => "524", "name" => "UNIDAD HABITACIONAL JOSE MARIA MORELOS Y PAVON"],
            ["number" => "525", "name" => "VICENTE GUERRERO, TLATENCHI"],
            ["number" => "526", "name" => "CENTRO, TLATENCHI"],
            ["number" => "527", "name" => "ALTA VISTA"],
            ["number" => "528", "name" => "PEDRO AMARO"],
            ["number" => "529", "name" => "INDEPENDENCIA"],
            ["number" => "530", "name" => "CENTRO, HIGUERON"],
            ["number" => "531", "name" => "EL HIFUERON"],
            ["number" => "532", "name" => "CHISCO"],
            ["number" => "533", "name" => "LA NOPALERA"],
            ["number" => "534", "name" => "CENTRO, TEHUIXTLA"],
            ["number" => "535", "name" => "TEHUIXTLA"],
            ["number" => "536", "name" => "GUADALUPE VICTORIA"],
        ];

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, count($sections));

        // Mensaje de inicio
        $output->writeln('<info>Comenzando la inserción de datos en la tabla Sections...</info>');

        $progressBar->start();

        foreach ($sections as $section) {
            // Crea una nueva sección utilizando el modelo Section
            Section::create([
                'number' => $section['number'],
                'name' => $section['name'],
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');

        // Mensaje de finalización
        $output->writeln('<info>¡La inserción de datos en la tabla Sections ha finalizado!</info>');
    }
}
