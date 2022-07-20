<?php

namespace Database\Seeders;

use App\Models\LeadManager;
use Illuminate\Database\Seeder;

class LeadManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadManager::factory()
            ->count(5)
            ->create();
    }
}
