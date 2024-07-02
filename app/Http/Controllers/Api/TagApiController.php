<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'tags' => Tag::whereNull('deleted_at')->get()
        ]);
    }

    public function show(Request $request, $slug)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'tag' => Tag::with('campaigns', 'clients', 'clients.user', 'mails')->where('slug', $slug)->firstOrFail()
        ]);
    }

    public function destroy(Request $request, $slug)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'tag' => Tag::where('slug', $slug)->firstOrFail()->delete()
        ]);
    }
}
