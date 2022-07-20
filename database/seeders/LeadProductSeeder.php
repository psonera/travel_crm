<?php

namespace Database\Seeders;

use App\Models\LeadProduct;
use Illuminate\Database\Seeder;

class LeadProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadProduct::factory()
            ->count(5)
            ->create();
    }
}
