<?php

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Perusahaan;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
