<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'mails' => Mail::whereNull('deleted_at')->get()
        ]);
    }

    public function show(Request $request, $id)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'mail' => Mail::with('tags')->findOrFail($id)
        ]);
    }
}
