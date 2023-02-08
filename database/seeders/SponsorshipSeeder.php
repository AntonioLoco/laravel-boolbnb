<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = config("sponsorship");
        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = Sponsorship::create([
                'name' => $sponsorship['name'],
                'price' => $sponsorship['price'],
                'hours' => $sponsorship['hours']
            ]);
        }
    }
}
