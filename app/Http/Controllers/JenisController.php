<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Jenis;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        $jenis = Jenis::all();

        if ($request->ajax()) {
            $jenis = Jenis::select(['id','nama']);
            return Datatables::of($jenis)
            ->addColumn('action', function($jenis){
                return view('datatable._action', [
                    'model'=> $jenis,
                    'form_url'=> route('jenis.destroy', $jenis->id),
                    'edit_url' => route('jenis.edit', $jenis->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $jenis->nama . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Jenis'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 
            'searchable'=>false]);
        // return $html;
        // dd($html);
        return view('jenis.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama' => 'required|unique:jenis']);
        $jenis = Jenis::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $jenis->nama"
            ]);
        return redirect()->route('jenis.index');
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
        $jenis = Jenis::find($id);
        return view('jenis.edit')->with(compact('jenis'));
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
        $this->validate($request, ['nama' => 'required|unique:jenis,nama,'. $id]);
        $jenis = Jenis::find($id);
        $jenis->update($request->only('nama'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $jenis->nama"
            ]);
        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Jenis::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Jenis berhasil dihapus"
            ]);
        return redirect()->route('jenis.index');
    }
}
