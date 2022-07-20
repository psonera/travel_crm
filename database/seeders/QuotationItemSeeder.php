<?php

namespace Database\Seeders;

use App\Models\QuotationItem;
use Illuminate\Database\Seeder;

class QuotationItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuotationItem::factory()
            ->count(5)
            ->create();
    }
}
