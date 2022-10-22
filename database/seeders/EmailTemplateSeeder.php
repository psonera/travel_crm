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
                <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
                    <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
                        <div class="mx-auto max-w-md">
                        <img src="/img/logo.svg" class="h-8 mx-auto mb-8" alt="Thrill Blazers" />
                        <p class="mt-5 ml-8 text-2xl font-semibold items-center text-black">You have a new activity, please find the details below:</p>
                        <hr class="mt-5"> 
                        <div class="divide-y divide-gray-300/50">
                            <div class="flex-auto p-4 pb-0 pt-3">
                            <ul class="mb-6 flex flex-col rounded-lg pl-0">
                                <li class="rounded-t-inherit text-size-inherit relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Title</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.title%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Type</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.type%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Date</h6>
                                </div>
                                <div class="ml-24 flex items-center text-lg leading-normal">{%activities.schedule_from%} to {%activities.schedule_to%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Participants</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.participants%}</div>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>',
            ],
            [
                'name' =>'Activity modified',
                'subject'=>'Activity modified: {%activities.title%}',
                'content'=>'	
                <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
                    <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
                        <div class="mx-auto max-w-md">
                        <img src="/img/logo.svg" class="h-8 mx-auto mb-8" alt="Thrill Blazers" />
                        <p class="mt-5 ml-8 text-2xl font-semibold items-center text-black">This activity has been modified, please find the details below:</p>
                        <hr class="mt-5"> 
                        <div class="divide-y divide-gray-300/50">
                            <div class="flex-auto p-4 pb-0 pt-3">
                            <ul class="mb-6 flex flex-col rounded-lg pl-0">
                                <li class="rounded-t-inherit text-size-inherit relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Title</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.title%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Type</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.type%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Date</h6>
                                </div>
                                <div class="ml-24 flex items-center text-lg leading-normal">{%activities.schedule_from%} to {%activities.schedule_to%}</div>
                                </li>
                                <li class="relative ml-4 mb-2 flex justify-between rounded-xl border-0 bg-white px-4 py-2 pl-0 text-inherit">
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-lg font-semibold leading-normal text-slate-700">Participants</h6>
                                </div>
                                <div class="flex items-center text-lg leading-normal">{%activities.participants%}</div>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>',
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
