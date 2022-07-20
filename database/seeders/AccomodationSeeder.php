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
        Accomodation::factory()
            ->count(5)
            ->create();
    }
}
