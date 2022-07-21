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
                'lead_pipeline_id'=>'1'
            ],
            [
                'code'=>'follow up',
                'name' =>'Follow Up',
                'probability'=>'100',
                'sort_order'=>'2',
                'lead_pipeline_id'=>'1'
            ],
            [
                'code'=>'prospect',
                'name' =>'Prospect',
                'probability'=>'100',
                'sort_order'=>'3',
                'lead_pipeline_id'=>'1'
            ],
            [
                'code'=>'negotiation',
                'name' =>'Negotiation',
                'probability'=>'100',
                'sort_order'=>'4',
                'lead_pipeline_id'=>'1'
            ],
            [
                'code'=>'won',
                'name' =>'Won',
                'probability'=>'100',
                'sort_order'=>'5',
                'lead_pipeline_id'=>'1'
            ],
            [
                'code'=>'lost',
                'name' =>'Lost',
                'probability'=>'0',
                'sort_order'=>'6',
                'lead_pipeline_id'=>'1'
            ],

            ])->each(function($leadpiplelinestage){

                $leadpiplelinestage = LeadPipelineStage::create([
                    'code' => $leadpiplelinestage['code'],
                    'name' => $leadpiplelinestage['name'],
                    'probability' => $leadpiplelinestage['probability'],
                    'sort_order' => $leadpiplelinestage['sort_order'],
                    'lead_pipeline_id' => $leadpiplelinestage['lead_pipeline_id'],
                ]);
            });

    }
}
