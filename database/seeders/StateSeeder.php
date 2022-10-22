<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\State as ModelsState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
                ["id"=>4006, "name"=>'Meghalaya', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'ML'],
                ["id"=>4007, "name"=>'Haryana', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'HR'],
                ["id"=>4008, "name"=>'Maharashtra', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'MH'],
                ["id"=>4009, "name"=>'Goa', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'GA'],
                ["id"=>4010, "name"=>'Manipur', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'MN'],
                ["id"=>4011, "name"=>'Puducherry', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'PY'],
                ["id"=>4012, "name"=>'Telangana', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'TG'],
                ["id"=>4013, "name"=>'Odisha', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'OR'],
                ["id"=>4014, "name"=>'Rajasthan', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'RJ'],
                ["id"=>4015, "name"=>'Punjab', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'PB'],
                ["id"=>4016, "name"=>'Uttarakhand', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'UT'],
                ["id"=>4017, "name"=>'Andhra Pradesh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',       "state_code"=>'AP'],
                ["id"=>4018, "name"=>'Nagaland', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'NL'],
                ["id"=>4019, "name"=>'Lakshadweep', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'LD'],
                ["id"=>4020, "name"=>'Himachal Pradesh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',         "state_code"=>'HP'],
                ["id"=>4021, "name"=>'Delhi', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'DL'],
                ["id"=>4022, "name"=>'Uttar Pradesh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',        "state_code"=>'UP'],
                ["id"=>4023, "name"=>'Andaman and Nicobar Islands', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',      "state_code"=>'AN'],
                ["id"=>4024, "name"=>'Arunachal Pradesh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',        "state_code"=>'AR'],
                ["id"=>4025, "name"=>'Jharkhand', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'JH'],
                ["id"=>4026, "name"=>'Karnataka', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'KA'],
                ["id"=>4027, "name"=>'Assam', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'AS'],
                ["id"=>4028, "name"=>'Kerala', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'KL'],
                ["id"=>4029, "name"=>'Jammu and Kashmir', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',        "state_code"=>'JK'],
                ["id"=>4030, "name"=>'Gujarat', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'GJ'],
                ["id"=>4031, "name"=>'Chandigarh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'CH'],
                ["id"=>4033, "name"=>'Dadra and Nagar Haveli and Daman and Diu', "country_id"=>101, "country_code"=>'IN',      "country_name"=>'India', "state_code"=>'DH'],
                ["id"=>4034, "name"=>'Sikkim', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'SK'],
                ["id"=>4035, "name"=>'Tamil Nadu', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'TN'],
                ["id"=>4036, "name"=>'Mizoram', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'MZ'],
                ["id"=>4037, "name"=>'Bihar', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'BR'],
                ["id"=>4038, "name"=>'Tripura', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'TR'],
                ["id"=>4039, "name"=>'Madhya Pradesh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',       "state_code"=>'MP'],
                ["id"=>4040, "name"=>'Chhattisgarh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India',         "state_code"=>'CT'],
                ["id"=>4852, "name"=>'Ladakh', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'LA'],
                ["id"=>4853, "name"=>'West Bengal', "country_id"=>101, "country_code"=>'IN', "country_name"=>'India', "state_code"=>'WB']
        ];

        ModelsState::insert($data);

    }
}
