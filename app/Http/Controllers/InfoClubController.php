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
                 ->leftjoin('teams','members.club_id','teams.club_id')
                 ->select('members.id as member_id','clubs.iduser as id_userclub','clubs.club_name','clubs.file as club_file','clubs.description as club_desc','teams.team_name','teams.slogan','teams.desc as team_desc','teams.file as team_file','teams.members','teams.leader_team')
                 ->where('members.iduser',auth()->user()->id)
                 ->whereNull('members.deleted_at')
                 ->get();
        $users = User::where('active_member',1)->get();
        // return dd(compact('lists','users'));
        // Club::where('club_id',auth()->user()->id)->get();
        return view('pages.infoclub.index',compact('lists','users'));
    }
}
