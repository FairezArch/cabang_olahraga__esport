<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeaderForm;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;
class HeaderFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = HeaderForm::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.forms.index',compact('lists'));
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
        return view('pages.forms.add',compact('branchs'));
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
        $encode = json_encode($request->listquestions);
        HeaderForm::create(['branch_id'=>$request->branch,'header_title'=>$request->titleheader,'question_n_answer'=>$encode]);
        return response()->json(['success'=>true]);
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
        $form = HeaderForm::find($id);
        $branchs = Branchsport::get();
        return view('pages.forms.edit',compact('form','branchs'));
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
        $form = HeaderForm::find($id);
        $encode = json_encode($request->listquestions);
        $form->update(['branch_id'=>$request->branch,'header_title'=>$request->titleheader,'question_n_answer'=>$encode]);
        return response()->json(['success'=>true]);
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
        HeaderForm::find($id)->delete();
        return redirect()->route('forms.index')
        ->with('success', 'Forms has been deleted');

    }
}
