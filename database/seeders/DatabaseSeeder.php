<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Database\Seeders\AccomodationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => FacadesHash::make('admin'),
            ]);
            $this->call(PermissionsSeeder::class);
            $this->call(AccomodationSeeder::class);
            $this->call(ActivitySeeder::class);
            $this->call(ActivityParticipantSeeder::class);
            $this->call(EmailTemplateSeeder::class);
            $this->call(GroupSeeder::class);
            $this->call(LeadSourceSeeder::class);
            $this->call(LeadManagerSeeder::class);
            $this->call(LeadPipelineSeeder::class);
            $this->call(LeadPipelineStageSeeder::class);
            $this->call(LeadStageSeeder::class);
            $this->call(LeadTypeSeeder::class);
            $this->call(TripTypeSeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(LeadSeeder::class);
            $this->call(LeadProductSeeder::class);
            $this->call(QuotationSeeder::class);
            $this->call(QuotationItemSeeder::class);
            $this->call(TransportSeeder::class);
            $this->call(TripSeeder::class);
            $this->call(UserSeeder::class);
    }
}
