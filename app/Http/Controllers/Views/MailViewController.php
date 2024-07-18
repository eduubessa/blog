<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailViewController extends Controller
{
    //
    public function index()
    {
        return view('pages.mails.index');
    }
    public function edit(Request $request, int $id)
    {
        $mail = Mail::where('id', $id)->firstOrFail();

        return view('pages.mails.edit')
            ->with(['mail' => $mail]);
    }
}
