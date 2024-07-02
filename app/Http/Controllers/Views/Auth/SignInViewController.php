<?php

namespace App\Http\Controllers\Views\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInViewController extends Controller
{
    //
    public function form(Request $request)
    {
        return view('pages.auth.sign-in');
    }
}
