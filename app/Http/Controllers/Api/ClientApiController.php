<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
}
