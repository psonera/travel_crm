<?php

namespace Database\Seeders;

use App\Models\TripType;
use Illuminate\Database\Seeder;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' =>'Trekking'],
            ['name' =>'Leisure'],
            ['name' =>'Honeymoon'],
        ])->each(function($trip_type){
            $trip_type = TripType::create([
                'name' => $trip_type['name'],
            ]);
        });
    }
}
