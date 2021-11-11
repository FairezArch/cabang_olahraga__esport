<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Club;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Branchsport;


class ClubsController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:clubs-list|clubs-create|clubs-edit|clubs-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = Club::where('cabang_id', auth::user()->cabang_id)->paginate(5);
        return view('pages.clubs.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = DB::table('users')->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.role_id', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', 3)->get();
        $branchs = Branchsport::get();
        return view('pages.clubs.add', compact('users', 'branchs'));
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
            'user' => 'required|integer',
            'clubname' => 'required',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];

        $messages = [
            'user.required'       => 'Nama event wajib diisi',
            'clubname.required'     => 'Nama Club wajib diisi',
            'file.required'      => 'Logo Club wajib diupload',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $namefile = str_replace(' ', '_', $request->file->getClientOriginalName());
        $filename  = $namefile . '_' . time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $filename);


        Club::create([
            'iduser' => $request->user,
            'club_name' => $request->clubname,
            'slug' => Str::slug($request->clubname),
            'file' => $filename,
            'description' => $request->desc,
            'cabang_id' => $request->branch
        ]);

        return redirect()->route('clubs.index')
            ->with('success', 'Club create successfully');
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

        $club = Club::find($id);
        $users = DB::table('users')->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
        ->select('users.*', 'model_has_roles.role_id', 'model_has_roles.model_id')
        ->where('model_has_roles.role_id', 3)->get();
        $branchs = Branchsport::get();
        return view('pages.clubs.edit', compact('club', 'users', 'branchs'));
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
            'user' => 'required|integer',
            'clubname' => 'required',
        ];

        $messages = [
            'user.required'       => 'Nama event wajib diisi',
            'clubname.required'     => 'Nama Club wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $club = Club::find($id);
        $filename = $club->file;

        if (!empty($request->file)) {
            File::delete(public_path("uploads/" . $club->file));

            $namefile = str_replace(' ', '_', $request->file->getClientOriginalName());
            $filename  = $namefile . '_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $filename);
        }

        $club->update([
            'iduser' => $request->user,
            'club_name' => $request->clubname,
            'slug' => Str::slug($request->clubname),
            'file' => $filename,
            'description' => $request->desc,
            'cabang_id' => $request->branch
        ]);

        return redirect()->route('clubs.index')
            ->with('success', 'Club updated successfully');
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
        Club::find($id)->delete();
        return redirect()->route('clubs.index')
            ->with('success', 'Club deleted successfully');
    }

    public function participation($id)
    {
        # code...
        $lists = DB::table('participationevent')
            ->join('clubs', 'participationevent.club_id', 'clubs.id')
            ->join('teams', 'participationevent.team_id', 'teams.id')
            ->select('participationevent.club_id', 'participationevent.team_id', 'clubs.club_name', 'teams.team_name', 'teams.leader_team', 'teams.members')
            ->paginate(7);
        
        return view('pages.clubs.participation', compact('lists'));
    }
}
