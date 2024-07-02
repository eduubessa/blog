<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientViewController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('pages.clients.index');
    }

    public function show(Request $request, $id)
    {
        return view('pages.clients.show')
            ->with([
                'client' => Client::with('user')->find($id),
            ]);
    }
}
