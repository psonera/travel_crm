<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityParticipant;

class ActivityParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityParticipant::factory()
            ->count(5)
            ->create();
    }
}
