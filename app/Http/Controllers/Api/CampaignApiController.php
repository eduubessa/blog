<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'campaigns' => Campaign::with('tags')->get()
        ]);
    }

    public function show(Request $request, int $id)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'campaign' => Campaign::findOrFail($id)
        ]);
    }
}
