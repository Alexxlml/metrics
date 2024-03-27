<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        foreach ($neighborhoods as $neighborhood) {
            $new_neighborhood = Neighborhood::Create([
                'name' => $neighborhood['name'],
                'town_id' => $neighborhood['town_id']
            ]);
            $new_neighborhood->save();
        }
    }
}
