<?php

namespace Database\Seeders;

use App\Models\LeadPipeline;
use Illuminate\Database\Seeder;

class LeadPipelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadPipeline::factory()
            ->count(5)
            ->create();
    }
}
