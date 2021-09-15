<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{

    public function __construct()
    {
        # code...
        $this->middleware(['permission:events-list|events-create|events-edit|events-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = EventsModel::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.events.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $branchs = Branchsport::get();
        return view('pages.events.add',compact('branchs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3',
            'date'                  => 'required|date',
            'end'                   => 'required|date',
            'file'                  => 'required|file|mimes:jpg,jpeg,bmp,png'
        ];

        $messages = [
            'name.required'         => 'Nama event wajib diisi',
            'name.min'              => 'Nama event minimal 3 karakter',
            'date.required'         => 'Tanggal wajib diisi',
            'end.required'          => 'Tanggal wajib diisi',
            'file.required'         => 'Gambar wajib diupload'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $namefile = str_replace(' ','_', pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);

        EventsModel::create([
            'event_name' => $request->name,
            'slug' => Str::slug($request->name),//strtolower(str_replace(' ','-',$request->name)),
            'start_date' => $request->date,
            'end_date' => $request->end,
            'file' => $filename,
            'description' => $request->desc,
            'cabang_id'=>$request->branch
            
        ]);
        return redirect()->route('events.index')
            ->with('success', 'event created successfully');
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
        //
        $event = EventsModel::find($id);
        $branchs = Branchsport::get();
        return view('pages.events.edit', compact('event','branchs'));
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
        $rules = [
            'name'  => 'required|min:3',
            'date'  => 'required|date',
            'end'   => 'required|date'
        ];

        $messages = [
            'name.required'  => 'Nama event wajib diisi',
            'name.min'       => 'Nama event minimal 3 karakter',
            'date.required'  => 'Tanggal wajib diisi',
            'end.required'   => 'Tanggal wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $event = EventsModel::find($id);
        $filename = $event->file;

        if(!empty($request->file)){
            File::delete(public_path("uploads/".$event->file));
            $namefile = str_replace(' ','_', pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }

        $event->update([
            'event_name' => $request->name,
            'slug' => Str::slug($request->name),
            'start_date' => $request->date,
            'end_date' => $request->end,
            'file' => $filename,
            'description' => $request->desc,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('events.index')
            ->with('success', 'event created successfully');
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
        $event = EventsModel::find($id);
        if(!empty($event->file)){
            File::delete(public_path("uploads/".$event->file));
        }
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Events deleted successfully');
    }
}
