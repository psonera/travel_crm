<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeadPipelineStage;

class LeadPipelineStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'code'=>'new',
                'name' =>'New',
                'probability'=>'100',
                'sort_order'=>'1',
            ],
            [
                'code'=>'follow up',
                'name' =>'Follow Up',
                'probability'=>'100',
                'sort_order'=>'2',
            ],
            [
                'code'=>'prospect',
                'name' =>'Prospect',
                'probability'=>'100',
                'sort_order'=>'3',
            ],
            [
                'code'=>'negotiation',
                'name' =>'Negotiation',
                'probability'=>'100',
                'sort_order'=>'4',
            ],
            [
                'code'=>'won',
                'name' =>'Won',
                'probability'=>'100',
                'sort_order'=>'5',
            ],
            [
                'code'=>'lost',
                'name' =>'Lost',
                'probability'=>'0',
                'sort_order'=>'6',
            ],

            ])->each(function($leadpipelinestage){

                $leadpipelinestage = LeadPipelineStage::create([
                    'code' => $leadpipelinestage['code'],
                    'name' => $leadpipelinestage['name'],
                    'probability' => $leadpipelinestage['probability'],
                    'sort_order' => $leadpipelinestage['sort_order'],
                ]);
            });

    }
}
