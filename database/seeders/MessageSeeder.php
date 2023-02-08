<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = config("apartment");
        foreach ($apartments as $key => $apartment) { 
            $rndMsgNum = $faker->numberBetween(1, 10);
            for ($i = 0; $i < $rndMsgNum; $i++) {
                $message = Message::create([
                    'apartment_id' => $key + 1,
                    'fullname' => $faker->name(),
                    'email' => $faker->email(),
                    'message' => $faker->text(200)
                ]);
            }
        }
    }
}
