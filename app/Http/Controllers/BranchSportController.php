<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BranchSportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = BranchSport::where('user_id',auth::user()->id)->paginate(5);
        return view('pages.branchs.index',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.branchs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required',
        ];
  
        $messages = [
            'name.required' => 'Nama cabang wajib diisi',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Branchsport::create([
            'name' => $request->name,
            'user_id'=> auth::user()->id
        ]);

        return redirect()->route('branchs.index')
        ->with('success','Cabang create successfully');
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
        $branch = Branchsport::find($id);
        return view('pages.branchs.edit',compact('branch'));
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
            'name' => 'required',
        ];
  
        $messages = [
            'name.required' => 'Nama cabrang wajib diisi',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $branch = Branchsport::find($id);

        $branch->update([
            'name' => $request->name,
            'user_id'=> auth::user()->id
        ]);

        return redirect()->route('branchs.index')
        ->with('success','Cabang update successfully');
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
        Branchsport::find($id)->delete();
        return redirect()->route('branchs.index')
        ->with('success','Cabang deleted successfully');
    }
}
