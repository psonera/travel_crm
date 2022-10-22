<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReminderController;
use Illuminate\Console\Command;

class smsReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminder = new ReminderController();
        $reminder->smsReminder();
        $this->info('Success! Check your messages.');
        return "message send";
    }
}
