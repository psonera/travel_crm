<?php

namespace Database\Seeders;

use App\Models\LeadType;
use Illuminate\Database\Seeder;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' =>'New Customer'],
            ['name' =>'Existing Customer'],
            
        ])->each(function($leadtype){
            
            $leadtype = LeadType::create([
                'name' => $leadtype['name'],
            ]);
        });
    }
}
