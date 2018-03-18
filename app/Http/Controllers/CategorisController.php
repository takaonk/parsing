<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Categori;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class CategorisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        $categoris = Categori::all();

        if ($request->ajax()) {
            $categoris = Categori::select(['id','nama']);
            return Datatables::of($categoris)
            ->addColumn('action', function($categori){
                return view('datatable._action', [
                    'model'=> $categori,
                    'form_url'=> route('categoris.destroy', $categori->id),
                    'edit_url' => route('categoris.edit', $categori->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $categori->nama . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Categori'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 
            'searchable'=>false]);
        // return $html;
        // dd($html);
        return view('categoris.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama' => 'required|unique:categoris']);
        $categori = Categori::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan"
            ]);
        return redirect()->route('categoris.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categori = Categori::find($id);
        return view('categoris.edit')->with(compact('categori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['nama' => 'required|unique:categoris,nama,'. $id]);
        $categori = Categori::find($id);
        $categori->update($request->only('nama'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan"
            ]);
        return redirect()->route('categoris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Categori::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Categori berhasil dihapus"
            ]);
        return redirect()->route('categoris.index');
    }
}
