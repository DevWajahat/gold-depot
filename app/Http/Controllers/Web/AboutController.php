<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('screens.web.about.index');
    }
}
