<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Teammember;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class TeammembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
       $teammember = Teammember::all();

        if ($request->ajax()) {
            $teammembers = Teammember::select(['id','nama','jabatan','cover',]);
            return Datatables::of($teammembers)
            ->addColumn('cover', function($teammember){
                return '<img src="/img/'.$teammember->cover. '" height="100px" width="200px">';
            })
            ->addColumn('action', function($teammember){
                return view('datatable._action', [
                    'model'=> $teammember,
                    'form_url'=> route('teammembers.destroy', $teammember->id),
                    'edit_url'=> route('teammembers.edit', $teammember->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $teammember->title . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data' => 'jabatan', 'name'=>'jabatan', 'title'=>'Jabatan'])
        ->addColumn(['data' => 'cover', 'name'=>'cover', 'title'=>'Cover'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('teammembers.index')->with(compact('html','teammembers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teammembers.create');
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
            'nama'=> 'required|unique:teammembers,nama',
            'jabatan' => 'required',
            'cover'=> 'image|max:2048'
            ]);
        $teammember = Teammember::create($request->except('cover'));
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
// mengisi field cover di teammember dengan filename yang baru dibuat
            $teammember->cover = $filename;
            $teammember->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $teammember->nama"
            ]);
        return redirect()->route('teammembers.index');
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
        $teammembers = Teammember::find($id);

        return view('teammembers.edit')->with(compact('teammembers'));
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
            'nama'=> 'required|unique:teammembers,nama,'.$id,
            'jabatan' => 'required',
            'cover'=> 'image|max:2048'
            ]);
        $teammember = Teammember::find($id);
        $teammember->update($request->all());
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
            if ($teammember->cover) {
                $old_cover = $teammember->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $teammember->cover;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
                }
            }
// ganti field cover dengan cover yang baru
            $teammember->cover = $filename;
            $teammember->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $teammember->nama"
            ]);
        return redirect()->route('teammembers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teammember = Teammember::find($id);
// hapus cover lama, jika ada
        if ($teammember->cover) {
            $old_cover = $teammember->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
            . DIRECTORY_SEPARATOR . $teammember->cover;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
            }
        }
        $teammember->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Team Member berhasil dihapus"
            ]);
        return redirect()->route('teammembers.index');
    }
}
