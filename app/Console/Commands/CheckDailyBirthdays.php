<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\HappyBirthday;
use Illuminate\Console\Command;

class CheckDailyBirthdays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:birthdays:check-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check daily birthdays and send notifications if needed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $today = now()->format('m-d');

        $celebrants = User::whereRaw("DATE_FORMAT(birth_date, '%m-%d') = '{$today}'");

        if($celebrants->count() > 0){
            $celebrants->get()->each(function ($celebrant) {
                $celebrant->notify(new HappyBirthday($celebrant));
            });
        }
    }
}
