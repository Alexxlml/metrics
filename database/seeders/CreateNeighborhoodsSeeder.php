<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateNeighborhoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $neighborhoods = [
            ["name" => "ALTAVISTA", "town_id" => 1,],
            ["name" => "CHISCO", "town_id" => 2,],
            ["name" => "PUESTA DEL SOL", "town_id" => 2,],
            ["name" => "CONSTITUCION DEL 57", "town_id" => 3,],
            ["name" => "HIGUERON", "town_id" => 4,],
            ["name" => "RICARDO SOTO", "town_id" => 4,],
            ["name" => "CAMPO EL CERRIL", "town_id" => 4,],
            ["name" => "INDEPENDENCIA", "town_id" => 5,],
            ["name" => "JICARERO", "town_id" => 6,],
            ["name" => "EL ARBOLITO", "town_id" => 6,],
            ["name" => "BENITO JUAREZ", "town_id" => 7,],
            ["name" => "CENTRO", "town_id" => 7,],
            ["name" => "CUAUHTEMOC", "town_id" => 7,],
            ["name" => "DEL BOSQUE", "town_id" => 7,],
            ["name" => "EL HIGUERON", "town_id" => 7,],
            ["name" => "EL JAGUEY", "town_id" => 7,],
            ["name" => "EL POCHOTE", "town_id" => 7,],
            ["name" => "EL ZAPATITO", "town_id" => 7,],
            ["name" => "EMILIANO ZAPATA", "town_id" => 7,],
            ["name" => "JARDINES DEL PARAISO", "town_id" => 7,],
            ["name" => "FRACCIONAMIENTO REFORMA", "town_id" => 7,],
            ["name" => "LA PASTRANA", "town_id" => 7,],
            ["name" => "LOS ARROZALES", "town_id" => 7,],
            ["name" => "PARAISO 2000", "town_id" => 7,],
            ["name" => "SAN JERONIMO", "town_id" => 7,],
            ["name" => "FRACCIONAMIENTO 19 DE SEP", "town_id" => 7,],
            ["name" => "LIBRAMIENTO PROL. DE LEYVA", "town_id" => 7,],
            ["name" => "LAS CALAVERAS", "town_id" => 7,],
            ["name" => "LAZARO CARDENAS", "town_id" => 8,],
            ["name" => "AMPLIACION 1", "town_id" => 8,],
            ["name" => "AMPLIACION 2", "town_id" => 8,],
            ["name" => "LOS PILARES", "town_id" => 9,],
            ["name" => "NICOLAS BRAVO", "town_id" => 10,],
            ["name" => "Loma de Oro", "town_id" => 11,],
            ["name" => "Tenerías", "town_id" => 11,],
            ["name" => "Colonia Álamos (La Frontera)", "town_id" => 11,],
            ["name" => "Campo San Pablo", "town_id" => 11,],
            ["name" => "El Tular [Bodega de Fertilizantes]", "town_id" => 11,],
            ["name" => "Campo Nexpa", "town_id" => 11,],
            ["name" => "Rancho la Joya (La Joya del Panteón)", "town_id" => 11,],
            ["name" => "Rancho de Armando Ramírez", "town_id" => 11,],
            ["name" => "Rancho los Ciruelos", "town_id" => 11,],
            ["name" => "Rancho San Francisco (La Mesa del Cuajiote)", "town_id" => 11,],
            ["name" => "Rancho la Joya", "town_id" => 11,],
            ["name" => "Agua del Coyote", "town_id" => 11,],
            ["name" => "Barranca del Muerto", "town_id" => 11,],
            ["name" => "La Bomba (Barranca Panchomas)", "town_id" => 11,],
            ["name" => "Las Brasileras", "town_id" => 11,],
            ["name" => "Campo las Camarillas", "town_id" => 11,],
            ["name" => "Campo el Fabián", "town_id" => 11,],
            ["name" => "Campo la Purísima", "town_id" => 11,],
            ["name" => "Campo de Tiro", "town_id" => 11,],
            ["name" => "La Catalana", "town_id" => 11,],
            ["name" => "Rancho los Cuchis", "town_id" => 11,],
            ["name" => "Colonia la Azuchilera", "town_id" => 11,],
            ["name" => "Colonia Guadalupe", "town_id" => 11,],
            ["name" => "Los Estanques (Campo Torres Burgos)", "town_id" => 11,],
            ["name" => "Frente a la Tranca Campo San Pablo", "town_id" => 11,],
            ["name" => "El Guayabo (El Tiradero)", "town_id" => 11,],
            ["name" => "Los Guayabitos", "town_id" => 11,],
            ["name" => "Loma del Coyote", "town_id" => 11,],
            ["name" => "Brasilera Chica", "town_id" => 11,],
            ["name" => "Rancho los Arenales", "town_id" => 11,],
            ["name" => "Rancho Juan Ibáñez", "town_id" => 11,],
            ["name" => "Las Sidras", "town_id" => 11,],
            ["name" => "El Canalito", "town_id" => 11,],
            ["name" => "Huajes", "town_id" => 11,],
            ["name" => "La Joya (Ojo de Agua)", "town_id" => 11,],
            ["name" => "Bomba de las Camarillas", "town_id" => 11,],
            ["name" => "El Abrevadero", "town_id" => 11,],
            ["name" => "El Reparito", "town_id" => 11,],
            ["name" => "La Mesa de los Indios", "town_id" => 11,],
            ["name" => "Otra", "town_id" => 11,],
            ["name" => "PANCHIMALCO", "town_id" => 12,],
            ["name" => "LAS CAÑAS", "town_id" => 12,],
            ["name" => "PEDRO AMARO", "town_id" => 13,],
            ["name" => "CAMPO EL CERRIL", "town_id" => 13,],
            ["name" => "RIO SECO", "town_id" => 14,],
            ["name" => "CENTRO", "town_id" => 15,],
            ["name" => "LA NOPALERA", "town_id" => 15,],
            ["name" => "LA AZUCHILERA", "town_id" => 15,],
            ["name" => "LOS AMATES", "town_id" => 15,],
            ["name" => "EL ROSARIO", "town_id" => 15,],
            ["name" => "LOS NARANJOS", "town_id" => 15,],
            ["name" => "PIEDRAS BLANCAS", "town_id" => 15,],
            ["name" => "EMILIANO ZAPATA", "town_id" => 15,],
            ["name" => "LOMA BONITA", "town_id" => 15,],
            ["name" => "GUADALUPE", "town_id" => 15,],
            ["name" => "SAN PEDRO", "town_id" => 15,],
            ["name" => "FRACC. ARBOLEDAS DEL RIO", "town_id" => 15,],
            ["name" => "FRACC. LOS MANDARINES", "town_id" => 15,],
            ["name" => "FRACC. BALCONES DE TEHUIXTLA", "town_id" => 15,],
            ["name" => "CONJ. HAB. RINCONADA JARDINES DE TEHUIXTLA", "town_id" => 15,],
            ["name" => "CENTRO", "town_id" => 16,],
            ["name" => "5A. SECCION", "town_id" => 16,],
            ["name" => "3 DE MAYO", "town_id" => 16,],
            ["name" => "LOMA BONITA", "town_id" => 16,],
            ["name" => "BELLA VISTA", "town_id" => 16,],
            ["name" => "RESIDENCIAL VILLA TEQUES", "town_id" => 16,],
            ["name" => "HORNOS CUATES", "town_id" => 16,],
            ["name" => "FRACCIONAMIENTO EL PROA (Hornos cuates)", "town_id" => 16,],
            ["name" => "COLONIA DE LA CRUZ", "town_id" => 16,],
            ["name" => "LAS PALMAS", "town_id" => 16,],
            ["name" => "CENTRO", "town_id" => 17,],
            ["name" => "EL ARENAL", "town_id" => 17,],
            ["name" => "BUENOS AIRES", "town_id" => 17,],
            ["name" => "SANTA MARIA", "town_id" => 17,],
            ["name" => "AZTECA I", "town_id" => 17,],
            ["name" => "AZTECA II", "town_id" => 17,],
            ["name" => "VICENTE GUERRERO", "town_id" => 17,],
            ["name" => "CENTRO AMERICA", "town_id" => 17,],
            ["name" => "AZTECA III", "town_id" => 17,],
            ["name" => "5 DE MAYO", "town_id" => 17,],
            ["name" => "EL BARRO", "town_id" => 17,],
            ["name" => "CONJ. HAB. MANANTIAL I", "town_id" => 17,],
            ["name" => "CONJ. HAB. MANANTIAL II", "town_id" => 17,],
            ["name" => "CONJ. HAB. MANANTIAL III", "town_id" => 17,],
            ["name" => "U. HAB. EL ARENAL II", "town_id" => 17,],
            ["name" => "U. HAB. EL ARENAL II", "town_id" => 17,],
            ["name" => "U. HAB. LOS VENADOS I", "town_id" => 17,],
            ["name" => "U. HAB. LOS VENADOS II", "town_id" => 17,],
            ["name" => "U. HAB. DE LOS MAESTROS", "town_id" => 17,],
            ["name" => "U. HAB. LOMA DEL SOL", "town_id" => 17,],
            ["name" => "RESIDENCIAL LOMA LA LIEBRE", "town_id" => 17,],
            ["name" => "FRACC. VALLE DORADO", "town_id" => 17,],
            ["name" => "U. HAB. JOSE MA. MORELOS Y PAVON", "town_id" => 18,],
            ["name" => "VICENTE ARANDA (SAN RAFAEL)", "town_id" => 19,],
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
