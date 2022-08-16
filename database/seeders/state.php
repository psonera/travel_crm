<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\State as ModelsState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class state extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `states` (`id`, `name`, `contrie_id`) VALUES
        (1, 'ANDHRA PRADESH', 1),
        (2, 'ASSAM', 1),
        (3, 'ARUNACHAL PRADESH', 1),
        (4, 'BIHAR', 1),
        (5, 'GUJRAT', 1),
        (6, 'HARYANA', 1),
        (7, 'HIMACHAL PRADESH', 1),
        (8, 'JAMMU & KASHMIR', 1),
        (9, 'KARNATAKA', 1),
        (10, 'KERALA', 1),
        (11, 'MADHYA PRADESH', 1),
        (12, 'MAHARASHTRA', 1),
        (13, 'MANIPUR', 1),
        (14, 'MEGHALAYA', 1),
        (15, 'MIZORAM', 1),
        (16, 'NAGALAND', 1),
        (17, 'ORISSA', 1),
        (18, 'PUNJAB', 1),
        (19, 'RAJASTHAN', 1),
        (20, 'SIKKIM', 1),
        (21, 'TAMIL NADU', 1),
        (22, 'TRIPURA', 1),
        (23, 'UTTAR PRADESH', 1),
        (24, 'WEST BENGAL', 1),
        (25, 'DELHI', 1),
        (26, 'GOA', 1),
        (27, 'PONDICHERY', 1),
        (28, 'LAKSHDWEEP', 1),
        (29, 'DAMAN & DIU', 1),
        (30, 'DADRA & NAGAR', 1),
        (31, 'CHANDIGARH', 1),
        (32, 'ANDAMAN & NICOBAR', 1),
        (33, 'UTTARANCHAL', 1),
        (34, 'JHARKHAND', 1),
        (35, 'CHATTISGARH', 1);");
    }
}
