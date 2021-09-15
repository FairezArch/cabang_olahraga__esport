<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardsModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;
class AwardsController extends Controller
{

    public function __construct()
    {
        # code...
        $this->middleware(['permission:awards-list|awards-create|awards-edit|awards-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = AwardsModel::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.awards.index',compact('lists'));
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
        return view('pages.awards.add',compact('branchs'));
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
            'awardname' => 'required|min:3',
            'desc'      => 'required|min:5',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
  
        $messages = [
            'awardname.required'    => 'Nama hadiah wajib diisi',
            'awardname.min'         => 'Nama hadiah minimal 3 karakter',
            'desc.required'         => 'Deskripsi wajib diisi',
            'desc.min'              => 'Deskripsi minimal 3 karakter',
            'file.required'         => 'Gambar harap diupload'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);
        
        AwardsModel::create([
            'award_name' => $request->awardname,
            'slug' => Str::slug($request->awardname),
            'award_logo' => $filename,
            'description' => $request->desc,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('awards.index')
        ->with('success','Award created successfully');

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

        $award = AwardsModel::find($id);
        $branchs = Branchsport::get();
        return view('pages.awards.edit',compact('award','branchs'));
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
        //
        $rules = [
            'awardname' => 'required|min:3',
            'desc'      => 'required|min:5',
        ];
  
        $messages = [
            'awardname.required'    => 'Nama hadiah wajib diisi',
            'awardname.min'         => 'Nama hadiah minimal 3 karakter',
            'desc.required'         => 'Deskripsi wajib diisi',
            'desc.min'              => 'Deskripsi minimal 3 karakter',
        ];
        
        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $award = AwardsModel::find($id);

        $filename = $award->award_logo;
        if(!empty($request->file)){
            File::delete(public_path("uploads/".$award->award_logo));

            $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }

        $award->update([
            'award_name' => $request->awardname,
            'slug' => Str::slug($request->awardname),
            'award_logo' => $filename,
            'description' => $request->desc,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('awards.index')
        ->with('success','Award updated successfully');
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
        AwardsModel::find($id)->delete();
        return redirect()->route('awards.index')
                        ->with('success','Award deleted successfully');
    }
}
