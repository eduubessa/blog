<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagViewController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('pages.tags.index');
    }
}
