<?php

namespace Database\Seeders;

use App\Models\Accomodation;
use Illuminate\Database\Seeder;

class AccomodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' =>'Tent'],
            ['name' =>'Swiss Tents'],
            ['name' =>'Home Space'],
            ['name' =>'Villa'],
            ['name' =>'3 Star Hotel'],
            ['name' =>'5 Star Hotel'],
        ])->each(function($accomodation){
            $accomodation = Accomodation::create([
                'name' => $accomodation['name'],
            ]);
        });
    }
}
