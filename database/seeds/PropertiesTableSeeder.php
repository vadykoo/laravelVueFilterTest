<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = json_decode(file_get_contents(base_path('database/seeds/json/properties.json')));

        foreach ($values as $value) {
            \App\Property::create([
                'name'         => $value->name,
                'price'        => $value->price,
                'bedrooms'     => $value->bedrooms,
                'bathrooms'    => $value->bathrooms,
                'storeys'      => $value->storeys,
                'garages'      => $value->garages,
            ]);
        }
    }
}
