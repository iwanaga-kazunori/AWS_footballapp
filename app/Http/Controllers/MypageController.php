<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('mypage.index');
    }
}
