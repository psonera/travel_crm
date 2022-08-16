<?php

namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Email::factory()
        ->count(25)
        ->create();
    }
}
