<?php

use App\Mail\CampaignMail;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->everyMinute();

Schedule::command('app:import:campaigns')->everyMinute();

Schedule::call(function () {
    $user = User::findOrFail(1);
    $campaign = Campaign::findOrFail(2);

    echo "Sending email to {$user->email} with campaign {$campaign->name}";

    Mail::to('GZS6a@example.com')->queue(new CampaignMail(user: $user, campaign: $campaign));
})->everyMinute();
