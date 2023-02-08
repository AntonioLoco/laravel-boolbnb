<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
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
            $rndViewNum = $faker->numberBetween(1, 20);
            for ($i = 0; $i < $rndViewNum; $i++) {
                $view = View::create([
                    'apartment_id' => $key + 1,
                    'ip_address' => $faker->localIpv4()
                ]);
            }
        }
    }
}
