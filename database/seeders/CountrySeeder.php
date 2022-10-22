<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Country::insert([
            "id"=>101,
            "name"=>"India",
            "iso3"=>"IND",
            "iso2"=>"IN",
            "currency_name"=>"Indian rupee"
        ]);
    }
}
