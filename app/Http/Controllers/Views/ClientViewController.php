<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Models\Client;
use App\Models\User;
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

    public function create(Request $request)
    {
        $avatar = Avatar::firstOrFail();

        return view('pages.clients.create')
            ->with([
                'avatar' => $avatar
            ]);
    }

    public function edit(Request $request, string $username)
    {
        $avatar = Avatar::firstOrFail();
        $user = User::with('client')->where('username', $username)->firstOrFail();

        return view('pages.clients.edit')
            ->with([
                'avatar' => $avatar,
                'user' => $user
            ]);
    }
}
