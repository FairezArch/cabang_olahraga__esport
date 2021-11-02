<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsModel;
use App\Models\News;
use App\Models\GamesModel;
class FrontendController extends Controller
{
    //
    public function index()
    {
        # code...
        $events = EventsModel::get();
        $news   = News::get();
        $games  = GamesModel::get();

        return view('frontend.index',compact('events','news','games'));
    }
}
