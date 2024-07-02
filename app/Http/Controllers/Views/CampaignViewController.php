<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignViewController extends Controller
{
    //
    public function index()
    {
        return view('pages.campaigns.index');
    }

    public function edit(Request $request, $id)
    {
        $campaign = Campaign::where('code', $id)->firstOrFail();

        return view('pages.campaigns.edit')
            ->with([
                'campaign' => $campaign
            ]);
    }
}
