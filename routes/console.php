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

Schedule::command('service:campaigns:import')->hourly();

Schedule::call(function () {
    $user = User::findOrFail(2);
    $campaign = Campaign::findOrFail(1);

    echo "Sending email to {$user->email} with campaign {$campaign->name}";

    Mail::to($user->email)->queue(new CampaignMail(user: $user, campaign: $campaign));

})->everyMinute();

