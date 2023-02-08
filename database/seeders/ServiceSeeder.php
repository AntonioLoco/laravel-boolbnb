<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config("service");
        foreach ($services as $service) {
            $newService = Service::create([
                'name' => $service['name'],
                'icon_name' => $service['icon_name']
            ]);
        }
    }
}
