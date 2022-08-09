<?php

namespace Database\Seeders;

use App\Models\Contry as ModelsContry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class contry extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsContry::create(
            ['name'=>"india"]
        );
    }
}
