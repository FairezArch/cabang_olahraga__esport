<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Spatie\Permission\Models\Role;
use App\Models\Club;
use App\Models\GamesModel;
use App\Models\EventsModel;
use App\Models\AwardsModel;
use App\Models\News;
use App\Models\TeamModel;
class DashboardController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware(['permission:dashboards']);
    }

    public function index()
    {
        # code...
        // return dd(auth()->user()->id);
        $modelrole = DB::table('model_has_roles')->where('model_id',auth()->user()->id)->first();
        $role = Role::where('id',$modelrole->role_id)->first();
        $awards = AwardsModel::where('cabang_id',auth::user()->cabang_id)->get();
        $events = EventsModel::where('cabang_id',auth::user()->cabang_id)->get();
        $news = News::where('cabang_id',auth::user()->cabang_id)->get();
        $games  = GamesModel::where('cabang_id',auth::user()->cabang_id)->get();
        $clubs = Club::where('cabang_id',auth::user()->cabang_id)->get();
        if($role->name == 'user' || $role->name == 'Club Members'){
            return view('pages.dashboard.dashboard', compact('news','awards','events','games','clubs'));
        }else{
            $teams = TeamModel::where('cabang_id',auth::user()->cabang_id)->get();
            return view('pages.dashboard.leader',compact('events','clubs','teams'));
        }  
    }

    public function eventview($slug)
    {
        # code...
        $event = EventsModel::where('slug',$slug)->first();
        return view('pages.dashboard.dash_event', compact('event'));
    }

    public function gameview($slug)
    {
        # code...
        $game = GamesModel::where('slug',$slug)->first();
        return view('pages.dashboard.dash_game', compact('game'));
    }

    public function awardview($slug)
    {
        # code...
        $award = AwardsModel::where('slug',$slug)->first();
        return view('pages.dashboard.dash_award', compact('award'));
    }
}
