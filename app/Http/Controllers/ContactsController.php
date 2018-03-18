<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Contact;
use Session;
use App\Poto;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
       $contact = Contact::all();

     if ($request->ajax()) {
        $contacts = Contact::select(['id','address','phone','email']);
        return Datatables::of($contacts)
        ->addColumn('action', function($contact){
            return view('datatable._action', [
                'model'=> $contact,
                'form_url'=> route('contacts.destroy', $contact->id),
                'edit_url'=> route('contacts.edit', $contact->id),
                'confirm_message' => 'Yakin mau menghapus ' . $contact->title . '?'
                ]);
        })->make(true);
    }
    $html = $htmlBuilder
    ->addColumn(['data' => 'address', 'name'=>'address', 'title'=>'Address'])
    ->addColumn(['data' => 'phone', 'name'=>'phone', 'title'=>'Phone'])
    ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
    ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
    return view('contacts.index')->with(compact('html','contact','poto'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
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
            'address'=> 'required|unique:contacts,address',
            'phone'=>'required|numeric',
            'email'=> 'required'
            ]);
        $contact = Contact::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan"
            ]);
        return redirect()->route('contacts.index');
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
        $contact = Contact::find($id);
        return view('contacts.edit')->with(compact('contact'));
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
            'address'=> 'required|unique:contacts,address,'.$id,
            'phone' => 'required|numeric',
            'email'=> 'required'
            ]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan data"
            ]);
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
