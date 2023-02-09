<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Address;
use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config("apartment");
        foreach ($apartments as $apartment) {
            $pathImage = "C:\Users\hp\OneDrive\Desktop\Immagini a caso\cover_images" . $apartment['cover_image'];
            $newApartment = Apartment::create([
                'user_id' => $apartment['user_id'],
                'title' => $apartment['title'],
                'slug' => Helpers::generateSlug($apartment['title']),
                'description' => $apartment['description'],
                'rooms_number' => $apartment['rooms_number'],
                'beds_number' => $apartment['beds_number'],
                'bathrooms_number' => $apartment['bathrooms_number'],
                'square_meters' => $apartment['square_meters'],
                'cover_image' => Storage::putFile('apartment_images', new File($pathImage)),
                'visible' => $apartment['visible'],
                'category_id' => $apartment['category_id'],
            ]);
            $newApartmentAddress = Address::create([
                'apartment_id' => $newApartment->id,
                'latitude' => $apartment['address']['latitude'],
                'longitude' => $apartment['address']['longitude'],
                'street_address' => $apartment['address']['street_address'],
                'house_number' => $apartment['address']['house_number'],
                'postal_code' => $apartment['address']['postal_code']
            ]);
            $newApartment->address()->save($newApartmentAddress);
            $newApartment->services()->attach($apartment['services']);
            if (isset($apartment['sponsorship'])) {
                $newApartment->sponsorships()->attach($apartment['sponsorship'], [
                    'end_date' => '2023-02-04', 'is_active' => 1
                ]);
            }
        }
    }
}
