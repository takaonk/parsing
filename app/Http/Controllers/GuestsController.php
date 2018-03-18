<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Perusahaan;
use App\Paket;
use App\Contact;
use App\ImageGallery;
use App\Blog;
use App\Post;
use App\Teammember;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Str;


class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request, Builder $htmlBuilder)
    {
       $perusahaan = Perusahaan::all();
       $contact = Contact::all();
       return view('guest.index')->with(compact('perusahaan','contact'));
   }


    public function about(Request $request, Builder $htmlBuilder)
    {
       $perusahaan = Perusahaan::all();
       return view('guest.about')->with(compact('perusahaan'));
    }

  
  public function paket(Request $request, Builder $htmlBuilder)
   {
        $paket = Paket::all();
        return view('guest.paket')->with(compact('paket'));
   }

   public function blog(Request $request, Builder $htmlBuilder)
   {
        $blog = Blog::all();
        return view('guest.blog')->with(compact('blog'));
   }

   public function team(Request $request, Builder $htmlBuilder)
   {
        $team = Teammember::all();
        return view('guest.team')->with(compact('team'));
   }

   public function gallery(Request $request, Builder $htmlBuilder)
   {
        $imagegallery = ImageGallery::all();
        // dd($imagegallery);
        return view('guest.gallery')->with(compact('imagegallery'));
   }

public function store(Request $request, Builder $htmlBuilder)
   {

 
   }

public function chat(Request $request, Builder $htmlBuilder)
    {
       
       return view('welcome');
   }
}
