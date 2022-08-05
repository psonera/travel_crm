<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' =>'By Road'],
            ['name' =>'By Railway'],
            ['name' =>'By Air'],
        ])->each(function($transport){
            $transport = Transport::create([
                'name' => $transport['name'],
            ]);
        });
    }
}
