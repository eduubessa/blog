<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;
use PHPUnit\Event\Facade;

class HomeViewController extends Controller
{
    //
    public function index(Request $request)
    {

        $clients = Client::count();
        $campaigns = Campaign::count();

        $today = now()->format('m-d');
        $nextWeek = now()->addWeek()->format('m-d');
        $messages = 0;
        $doctors = 0;

        $birthdays = User::with('avatar')->whereRaw("DATE_FORMAT(birth_date, '%m-%d') BETWEEN '{$today}' AND '{$nextWeek}'")
            ->limit(5)
            ->get();

        return view('pages.home')
            ->with([
                'clients' => $clients,
                'campaigns' => $campaigns,
                'messages' => $messages,
                'doctors' => $doctors,
                'birthdays' => $birthdays,
                'nextWeek' => $nextWeek,
                'smsCounterPerMonth' => '100, 152, 110, 60, 200, 153, 246, 542, 482, 152, 0, 0',
                'mailCounterPerMonth' => '100, 1520, 1150, 600, 2600, 953, 846, 1542, 1500, 852, 0, 0'
            ]);
    }
}
