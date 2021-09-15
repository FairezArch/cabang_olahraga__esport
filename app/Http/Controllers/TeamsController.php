<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamModel;
use App\Models\GamesModel;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:teams-list|teams-create|teams-edit|teams-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $teams = TeamModel::where('cabang_id',auth::user()->cabang_id)->paginate(7);
        return view('pages.teams.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $members = DB::table('users')
                    ->join('members','users.id','members.iduser')
                    ->select('users.*','members.status','members.iduser as member_user')
                    ->where('users.active',1)
                    ->where('members.status',1)
                    ->where('members.deleted_at',null)
                    ->get();
        $games = GamesModel::get();
        $branchs = Branchsport::get();
        return view('pages.teams.add',compact('members','games','branchs'));
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
            'nameteam'  => 'required|min:3',
            'slogan'    => 'required|min:3',
            'listgame'  => 'required|integer',
            'leader'    => 'required|integer',
            'listeam'   => 'required|array',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
            'cover'     => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
  
        $messages = [
            'nameteam.required'  => 'Nama Tim wajib diisi',
            'nameteam.min'       => 'Nama Tim minimal 3 karakter',
            'slogan.required'    => 'Slogan wajib diisi',
            'slogan.min'         => 'Slogan minimal 3 karakter',
            'listgame'           => 'Game wajib dipilih',
            'leader'             => 'Leader Tim wajib dipilih',
            'listeam'            => 'Tim pemain wajib dipilih',
            'file.required'      => 'Logo Tim wajib diupload',
            'cover.required'     => 'Cover Tim wajib diupload',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);
       
        $namefile1= str_replace(' ','_',$request->cover->getClientOriginalName());
        $filename1  = $namefile1.'_'.time().'.'.$request->cover->extension();  
        $request->cover->move(public_path('uploads'), $filename1);
    

        $random = '';
        for($i = 0; $i < 12; $i++) {
            $random .= mt_rand(0, 9);
        }

        $getRand = $random;
        $encode = json_encode($request->listeam);

        TeamModel::create([
            'team_id' => $getRand,
            'team_name'=> $request->nameteam,
            'slogan'=>$request->slogan,
            'desc'=>$request->desc,
            'file'=>$filename,
            'cover'=>$filename1,
            'games'=>$request->listgame,
            'members'=>$encode,
            'leader_team'=>$request->leader,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('teams.index')
        ->with('success','Team created successfully');
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
        $team = TeamModel::find($id);
        $games = GamesModel::get();
        $members = DB::table('users')
                    ->join('members','users.id','members.iduser')
                    ->select('users.*','members.status','members.iduser as member_user')
                    ->where('users.active',1)
                    ->where('members.status',1)
                    ->where('members.deleted_at',null)
                    ->get();
        $memberarr = [];
        $de = json_decode($team->members);
        foreach($de as $member){$memberarr[] = $member;}  
        $branchs = Branchsport::get();   
        return view('pages.teams.edit', compact('team','games','members','memberarr','branchs'));
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
            'nameteam'  => 'required|min:3',
            'slogan'    => 'required|min:3',
            'listgame'  => 'required|integer',
            'leader'    => 'required|integer',
            'listeam'   => 'required|array',
        ];
  
        $messages = [
            'nameteam.required'  => 'Nama Tim wajib diisi',
            'nameteam.min'       => 'Nama Tim minimal 3 karakter',
            'slogan.required'    => 'Slogan wajib diisi',
            'slogan.min'         => 'Slogan minimal 3 karakter',
            'listgame'           => 'Game wajib dipilih',
            'leader'             => 'Leader Tim wajib dipilih',
            'listeam'            => 'Tim pemain wajib dipilih',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $team = TeamModel::find($id);

        $filename = $team->file;
        $filename1 = $team->cover;
        
        if(!empty($request->file)){
            File::delete(public_path("uploads/".$team->file));

            $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }

        if(!empty($request->cover)){
            File::delete(public_path("uploads/".$team->cover));
            
            $namefile1= str_replace(' ','_',$request->cover->getClientOriginalName());
            $filename1  = $namefile1.'_'.time().'.'.$request->cover->extension();  
            $request->cover->move(public_path('uploads'), $filename1);
        }

        $encode = json_encode($request->listeam);

        $team->update([
            'team_name'=> $request->nameteam,
            'slogan'=>$request->slogan,
            'desc'=>$request->desc,
            'file'=>$filename,
            'cover'=>$filename1,
            'games'=>$request->listgame,
            'members'=>$encode,
            'leader_team'=>$request->leader,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('teams.index')
        ->with('success','Team updated successfully');
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
        TeamModel::find($id)->delete();
        return redirect()->route('teams.index')
                        ->with('success','Team deleted successfully');
    }
}
