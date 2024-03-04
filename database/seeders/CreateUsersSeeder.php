<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = Storage::json('fill.json');

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
        }
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
            . '@metrics.test';
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
