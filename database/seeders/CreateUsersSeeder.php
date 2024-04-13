<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = Storage::json('fill.json');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, count($users));

        // Mensaje de inicio
        $output->writeln('<info>Comenzando la inserción de datos en la tabla Users...</info>');

        $progressBar->start();

        foreach ($users as $user) {
            $email = $this->getUserEmail($user);
            $password = $this->getUserPassword($user);
            try {
                $new_user = User::create([
                    "name" => $user['full_name'],
                    "email" => $email,
                    "phone" => $user['phone'],
                    "password" => bcrypt($password),
                ]);

                $new_user->assignRole($user['role']);
            } catch (Exception $err) {
            }
            $progressBar->advance();
        }
        $progressBar->finish();
        $output->writeln('');

        // Mensaje de finalización
        $output->writeln('<info>¡La inserción de datos en la tabla Users ha finalizado!</info>');
    }

    private function getUserEmail(array $user): String
    {
        $email = $this->createUserEmail($user);
        return $email;
    }

    private function createUserEmail(array $user): String
    {
        return strtolower($user['first_name'][0])
            . strtolower($user['first_name'][1])
            . strtolower($user['first_surname'])
            . substr($user['phone'], -2)
            . '@metrics.com';
    }

    private function getUserPassword(array $user): String
    {
        $password = $this->createUserPassword($user);
        return $password;
    }

    private function createUserPassword(array $user): String
    {
        return strtoupper($user['first_name'][0])
            . strtolower($user['first_name'][1])
            . strtoupper($user['first_surname'][0])
            . strtolower($user['first_surname'][1])
            . substr($user['phone'], -2)
            . '@2024';
    }
}
