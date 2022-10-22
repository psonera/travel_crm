<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\AccomodationSeeder;
use Illuminate\Support\Facades\Hash as FacadesHash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin users
        $this->call(LeadSourceSeeder::class);

        $this->call(LeadPipelineStageSeeder::class);
        $this->call(LeadTypeSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(AccomodationSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(TripTypeSeeder::class);
        $this->call(TransportSeeder::class);
        $this->call(TripSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        // $this->call(UserSeeder::class);
    }
}
