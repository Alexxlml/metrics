<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateNeighborhoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $neighborhoods = [
            [
                'name' => 'LOMA DE ORO',
                'town_id' => 1,
            ],
            [
                'name' => 'LAS CALAVERAS',
                'town_id' => 2,
            ],
            [
                'name' => 'PUESTA DEL SOL',
                'town_id' => 3,
            ],
            [
                'name' => 'RICARDO SOTO',
                'town_id' => 4,
            ],
            [
                'name' => 'EL ARBOLITO',
                'town_id' => 5,
            ],
            [
                'name' => 'CENTRO',
                'town_id' => 6,
            ],
            [
                'name' => 'AMPLIACION 1',
                'town_id' => 7,
            ],
            [
                'name' => 'LAS CAÑAS',
                'town_id' => 8,
            ],
            [
                'name' => 'CAMPO EL CERRIL',
                'town_id' => 9,
            ],
            [
                'name' => 'CENTRO',
                'town_id' => 10,
            ],
            [
                'name' => 'CENTRO',
                'town_id' => 11,
            ],
            [
                'name' => 'CENTRO',
                'town_id' => 12,
            ],
        ];

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, count($neighborhoods));

        // Mensaje de inicio
        $output->writeln('<info>Comenzando la inserción de datos en la tabla Neighborhoods...</info>');

        $progressBar->start();

        foreach ($neighborhoods as $neighborhood) {
            $new_neighborhood = Neighborhood::Create([
                'name' => $neighborhood['name'],
                'town_id' => $neighborhood['town_id']
            ]);
            $new_neighborhood->save();
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');

        // Mensaje de finalización
        $output->writeln('<info>¡La inserción de datos en la tabla Neighborhoods ha finalizado!</info>');
    }
}
