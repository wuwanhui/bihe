<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Facades\Weixin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FinanceTakeController extends BaseController
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('site.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        return view('site.home');
    }

}
