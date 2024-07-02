<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'users' => User::all()
        ]);
    }

    public function show(Request $request, $username)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'user' => User::where('username', $username)->firstOrFail()
        ]);
    }
}
