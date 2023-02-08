<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Fabrizio",
                "lastname" => "Verdi",
                "date_of_birth" => "1990-05-10",
                "email" => "fabrizio@gmail.com",
                "password" => "password"
            ],
            [
                "name" => "Mario",
                "lastname" => "Blu",
                "date_of_birth" => "1985-03-11",
                "email" => "mario@gmail.com",
                "password" => "password"
            ],
            [
                "name" => "Olga",
                "lastname" => "Demina",
                "date_of_birth" => "1988-09-10",
                "email" => "olga@gmail.com",
                "password" => "password"
            ],
            [
                "name" => "Gina",
                "lastname" => "Rosa",
                "date_of_birth" => "2000-01-20",
                "email" => "gina@gmail.com",
                "password" => "password"
            ],
            [
                "name" => "Giusy",
                "lastname" => "Truzzi",
                "date_of_birth" => "2005-04-19",
                "email" => "giusy@gmail.com",
                "password" => "password"
            ]
        ];

        foreach ($users as $user) {
            $new_user = User::create([
                'name' => $user['name'],
                'lastname' => $user['lastname'],
                'date_of_birth' => $user['date_of_birth'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
