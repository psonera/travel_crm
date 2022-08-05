<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
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
                'name' =>'Activity created',
                'subject'=>'Activity created: {%activities.title%}',
                'content'=>'
                <p style="font-size: 16px; color: #5e5e5e;">You have a new activity, please find the details bellow:</p>
                <p><strong style="font-size: 16px;">Details</strong></p>
                <table style="height: 97px; width: 952px;">
                    <tbody>
                        <tr>
                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Title</td>
                            <td style="width: 770.047px; font-size: 16px;">{%activities.title%}</td>
                        </tr>
                        <tr>
                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Type</td>
                                <td style="width: 770.047px; font-size: 16px;">{%activities.type%}</td>
                        </tr>
                        <tr>
                            <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Date</td>
                            <td style="width: 770.047px; font-size: 16px;">{%activities.schedule_from%} to&nbsp;{%activities.schedule_to%}</td>
                        </tr>
                        <tr>
                            <td style="width: 116.953px; color: #546e7a; font-size: 16px; vertical-align: text-top;">Participants</td>
                            <td style="width: 770.047px; font-size: 16px;">{%activities.participants%}</td>
                        </tr>
                    </tbody>
                </table>',
            ],
            [
                'name' =>'Activity modified',
                'subject'=>'Activity modified: {%activities.title%}',
                'content'=>'	
                <p style="font-size: 16px; color: #5e5e5e;">This activity has been modified, please find the details bellow:</p>
                <p><strong style="font-size: 16px;">Details</strong></p>
                    <table style="height: 97px; width: 952px;">
                        <tbody>
                            <tr>
                                <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Title</td>
                                 <td style="width: 770.047px; font-size: 16px;">{%activities.title%}</td>
                            </tr>
                            <tr>
                                <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Type</td>
                                <td style="width: 770.047px; font-size: 16px;">{%activities.type%}</td>
                            </tr>
                            <tr>
                                <td style="width: 116.953px; color: #546e7a; font-size: 16px;">Date</td>
                                <td style="width: 770.047px; font-size: 16px;">{%activities.schedule_from%} to&nbsp;{%activities.schedule_to%}</td>
                            </tr>
                            <tr>
                                <td style="width: 116.953px; color: #546e7a; font-size: 16px; vertical-align: text-top;">Participants</td>
                                <td style="width: 770.047px; font-size: 16px;">{%activities.participants%}</td>
                            </tr>
                        </tbody>
                    </table>',
            ],
            ])->each(function($email_template){

                $email_template = EmailTemplate::create([
                    'name' => $email_template['name'],
                    'subject' => $email_template['subject'],
                    'content' => $email_template['content'],
                ]);
            });

    }
}
