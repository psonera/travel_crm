<?php

namespace Database\Seeders;

use App\Models\LeadStage;
use Illuminate\Database\Seeder;

class LeadStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadStage::factory()
            ->count(5)
            ->create();
    }
}
