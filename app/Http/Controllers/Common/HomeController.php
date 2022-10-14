<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    /**
     * Display the home view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('common.home');
    }

}
