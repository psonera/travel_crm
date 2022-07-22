<?php

namespace Database\Seeders;

use App\Models\LeadSource;
use Illuminate\Database\Seeder;

class LeadSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' =>'Direct'],
            ['name' =>'Email'],
            ['name' =>'Instagram'],
            ['name' =>'FaceBook'],
        ])->each(function($leadsource){
            
            $leadsource = LeadSource::create([
                'name' => $leadsource['name'],
            ]);
        });
    }
}
