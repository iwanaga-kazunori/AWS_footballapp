<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SnsController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('sns.index');
    }
}
