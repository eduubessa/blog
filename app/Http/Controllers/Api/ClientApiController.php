<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'clients' => Client::with('user')->whereNull('deleted_at')->get()
        ]);
    }

    public function store(ClientStoreRequest $request)
    {
        if(!$request->validated()) {
            return back()->withInput()->withErrors($request->errors());
        }

        $user = new User();
        $user->firstname = encrypt_data($request->input('firstname'));
        $user->lastname = encrypt_data($request->input('lastname'));
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('mobile_phone');
    }

