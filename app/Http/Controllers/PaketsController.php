<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Paket;
use App\Jenis;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class PaketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {

       $jenis = Jenis::all();
       $paket = Paket::all();

        if ($request->ajax()) {
            $pakets = Paket::with('jenis');
            return Datatables::of($pakets)
            ->addColumn('cover', function($paket){
                return '<img src="/img/'.$paket->cover. '" height="100px" width="200px">';
            })
            ->addColumn('action', function($paket){
                return view('datatable._action', [
                    'model'=> $paket,
                    'form_url'=> route('pakets.destroy', $paket->id),
                    'edit_url'=> route('pakets.edit', $paket->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $paket->title . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Paket'])
        ->addColumn(['data' => 'jenis.nama', 'name'=>'jenis.nama', 'title'=>'Nama Jenis'])
        ->addColumn(['data' => 'isi', 'name'=>'isi', 'title'=>'Isi'])
        ->addColumn(['data' => 'harga', 'name'=>'harga', 'title'=>'Harga'])
        ->addColumn(['data' => 'cover', 'name'=>'cover', 'title'=>'Cover'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('pakets.index')->with(compact('html','pakets','jenis'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nama'=> 'required|unique:pakets,nama',
            'jenis_id' => 'required|exists:jenis,id',
            'harga'=> 'required|numeric',
            'isi' => 'required',
            'cover'=> 'image|max:2048'
            ]);
        $paket = Paket::create($request->except('cover'));
// isi field cover jika ada cover yang diupload
        if ($request->hasFile('cover')) {
// Mengambil file yang diupload
            $uploaded_cover = $request->file('cover');
// mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
// membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
// menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_cover->move($destinationPath, $filename);
// mengisi field cover di paket dengan filename yang baru dibuat
            $paket->cover = $filename;
            $paket->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $paket->nama"
            ]);
        return redirect()->route('pakets.index');
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
        $paket = Paket::find($id);

        return view('pakets.edit')->with(compact('paket'));
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
        $this->validate($request, [
            'nama'=> 'required|unique:pakets,nama,'.$id,
            'jenis_id' => 'required|exists:jenis,id',
            'harga'=> 'required|numeric',
            'isi' => 'required',
            'cover'=> 'image|max:2048'
            ]);
        $paket = Paket::find($id);
        $paket->update($request->all());
        if ($request->hasFile('cover')) {
// menambil cover yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $extension = $uploaded_cover->getClientOriginalExtension();
// membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
// memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath, $filename);
// hapus cover lama, jika ada
            if ($paket->cover) {
                $old_cover = $paket->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $paket->cover;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
                }
            }
// ganti field cover dengan cover yang baru
            $paket->cover = $filename;
            $paket->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $paket->nama"
            ]);
        return redirect()->route('pakets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket = Paket::find($id);
// hapus cover lama, jika ada
        if ($paket->cover) {
            $old_cover = $paket->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
            . DIRECTORY_SEPARATOR . $paket->cover;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
            }
        }
        $paket->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Paket berhasil dihapus"
            ]);
        return redirect()->route('pakets.index');
    }
}
