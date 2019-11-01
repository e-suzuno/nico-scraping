<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function info()
    {

        $config = \App\Models\Config::all()->first();
        if (!$config) {
            $config = new Config(['scraping_num' => 1]);
        }
        $scraping_num = $config->scraping_num;

        return view('info', ['scraping_num' => $scraping_num]);
    }
}
