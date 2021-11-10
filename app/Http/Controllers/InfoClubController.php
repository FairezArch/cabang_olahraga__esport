<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;


class InfoClubController extends Controller
{
    //

    public function index()
    {
        # code...
        $lists = DB::table('clubs')
                 ->join('members','clubs.id','members.club_id')
                 ->join('users','clubs.iduser','users.id')
                 ->leftjoin('teams','members.club_id','teams.club_id')
                 ->select('members.id as member_id','clubs.iduser as id_userclub','clubs.club_name','clubs.file as club_file','clubs.description as club_desc','teams.team_name','teams.slogan','teams.desc as team_desc','teams.file as team_file','teams.members','teams.leader_team','users.name as owner_name','users.lastname as owner_lastname')
                 ->where('members.iduser',auth()->user()->id)
                 ->whereNull('members.deleted_at')
                 ->get();
        $users = User::where('id',auth()->user()->id)->get();
        // return dd($lists);
       
        return view('pages.infoclub.index',compact('lists','users'));
    }
}
