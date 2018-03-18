<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Blog;
use App\Categori;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {

       $categori = Categori::all();
       $blog = Blog::all();

        if ($request->ajax()) {
            $blogs = Blog::with('categoris');
            return Datatables::of($blogs)
            ->addColumn('cover', function($blog){
                return '<img src="/img/'.$blog->cover. '" height="100px" width="200px">';
            })
            ->addColumn('action', function($blog){
                return view('datatable._action', [
                    'model'=> $blog,
                    'form_url'=> route('blogs.destroy', $blog->id),
                    'edit_url'=> route('blogs.edit', $blog->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $blog->title . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'judul', 'name'=>'judul', 'title'=>'Judul'])
        ->addColumn(['data' => 'categoris.nama', 'name'=>'categoris.nama', 'title'=>'Categori'])
        ->addColumn(['data' => 'about', 'name'=>'about', 'title'=>'About'])
        ->addColumn(['data' => 'cover', 'name'=>'cover', 'title'=>'Cover'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('blogs.index')->with(compact('html','blogs','categoris'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
            'judul'=> 'required|unique:blogs,judul',
            'categoris_id' => 'required|exists:categoris,id',
            'about'=> 'required',
            'cover'=> 'image|max:2048'
            ]);
        $blog = Blog::create($request->except('cover'));
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
// mengisi field cover di blog dengan filename yang baru dibuat
            $blog->cover = $filename;
            $blog->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $blog->judul"
            ]);
        return redirect()->route('blogs.index');
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
        $blog = Blog::find($id);

        return view('blogs.edit')->with(compact('blog'));
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
            'judul'=> 'required|unique:blogs,judul,'.$id,
            'categoris_id' => 'required|exists:categoris,id',
            'about' => 'required',
            'cover'=> 'image|max:2048'
            ]);
        $blog = Blog::find($id);
        $blog->update($request->all());
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
            if ($blog->cover) {
                $old_cover = $blog->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $blog->cover;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
                }
            }
// ganti field cover dengan cover yang baru
            $blog->cover = $filename;
            $blog->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $blog->judul"
            ]);
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
// hapus cover lama, jika ada
        if ($blog->cover) {
            $old_cover = $blog->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
            . DIRECTORY_SEPARATOR . $blog->cover;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
            }
        }
        $blog->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Blog berhasil dihapus"
            ]);
        return redirect()->route('blogs.index');
    }
}
