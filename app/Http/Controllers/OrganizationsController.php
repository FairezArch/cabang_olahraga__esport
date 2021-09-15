<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Models\TeamModel;
use App\Models\EventOrganizations;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Str;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class OrganizationsController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:organizations-list|organizations-create|organizations-edit|organizations-delete']);
        $this->middleware(['permission:organizations-event-list|organizations-event-create|organizations-event-edit|organizations-event-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # code...
        $lists = Organization::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.organizations.index',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # code...
        $users = DB::table('users')->join('model_has_roles','users.id','model_has_roles.model_id')
                ->select('users.*','model_has_roles.role_id','model_has_roles.model_id')
                ->where('model_has_roles.role_id',4)->paginate(5);
        $teams = TeamModel::get();
        $branchs = Branchsport::get();
        return view('pages.organizations.add',compact('users','teams','branchs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # code...
        $rules = [
            'organizations' => 'required|min:3',
            'pengurus'  => 'required|integer',
            'listeam'  => 'required|array',
            
        ];
  
        $messages = [
            'organizations.required'  => 'Organization wajib diisi',
            'organizations.min'       => 'Organization minimal 3 karakter',
            'pengurus.required'       => 'Pengurus harap dipilih',
            'listeam.required'        => 'Tim harap dipilih',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teams = json_encode($request->listeam);
        Organization::create([
            'name_club' => $request->organizations,
            'owner_club' => $request->pengurus,
            'desc' => $request->desc,
            'team_name' => $teams,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('organizations.index')
        ->with('success','Organizations create successfully');
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
        # code...
        $organization = Organization::find($id);
        $users = User::where('active',1)->get();
        $teams = TeamModel::get();
        $memberarr = [];
        $de = json_decode($organization->team_name);
        foreach($de as $member){$memberarr[] = $member;} 
        $branchs = Branchsport::get();
        return view('pages.organizations.edit',compact('organization','users','teams','memberarr','branchs'));
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
        # code...
        $rules = [
            'organizations' => 'required|min:3',
            'pengurus'  => 'required|integer',
            'listeam'  => 'required|array',
            
        ];
  
        $messages = [
            'organizations.required'  => 'Organization wajib diisi',
            'organizations.min'       => 'Organization minimal 3 karakter',
            'pengurus.required'       => 'Pengurus harap dipilih',
            'listeam.required'        => 'Tim harap dipilih',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teams = json_encode($request->listeam);
        $organ = Organization::find($id);
        $organ->update([
            'name_club' => $request->organizations,
            'owner_club' => $request->pengurus,
            'desc' => $request->desc,
            'team_name' => $teams,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('organizations.index')
        ->with('success','Organizations updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # code...
        $event = EventOrganizations::where('idorganization',$id)->get();
        if(!empty($event)){
            EventOrganizations::where('idorganization',$id)->delete();
        }
        Organization::find($id)->delete();
        return redirect()->route('organizations.index')
                        ->with('success','Organizations deleted successfully');
    }

    public function eventindex($idorg)
    {
        # code...
        $lists = EventOrganizations::where('idorganization',$idorg)->paginate(5);
        return view('pages.organizations.event.index',compact('lists','idorg'));
    }

    public function eventcreate($idorg)
    {
        # code...
        return view('pages.organizations.event.add',compact('idorg'));
    }

    public function eventstore(Request $request, $idorg)
    {
        # code...
        $rules = [
            'event' => 'required|min:3',
            'start'  => 'required|date',
            'end'  => 'required|date',
            'file'      => 'required|file|mimes:jpg,jpeg,png'
            
        ];
  
        $messages = [
            'event.required'  => 'Organization wajib diisi',
            'event.min'       => 'Organization minimal 3 karakter',
            'start.required'          => 'Tanggal harap diinput',
            'end.required'        => 'Tanggal harap diinput',
            'file.required'  => 'Foto evnet wajib diupload'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $namefile= str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);
       
        EventOrganizations::create([
            'idorganization' => $idorg,
            'event_name' => $request->event,
            'slug' => Str::slug($request->event),
            'file' => $filename,
            'desc' => $request->desc,
            'start_date' => $request->start,
            'end_date' => $request->end
        ]);

        return redirect()->to('organizations/'.$idorg.'/event')
        ->with('success','Organizations events added successfully');
    }

    public function eventedit($idorg,$id)
    {
        # code...
        $eventorg = EventOrganizations::find($id);
        return view('pages.organizations.event.edit',compact('idorg','eventorg'));
    }

    public function eventupdate(Request $request, $idorg, $id)
    {
        # code...
        $rules = [
            'event' => 'required|min:3',
            'start'  => 'required|date',
            'end'  => 'required|date',
            
        ];
  
        $messages = [
            'event.required'  => 'Organization wajib diisi',
            'event.min'       => 'Organization minimal 3 karakter',
            'start.required'          => 'Tanggal harap diinput',
            'end.required'        => 'Tanggal harap diinput',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $event = EventOrganizations::find($id);
        $filename = $event->file;

        if(!empty($request->file)){
            File::delete(public_path("uploads/".$event->file));
            $namefile = str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }
        $event->update([
            'idorganization' => $request->idorg,
            'event_name' => $request->event,
            'slug' => Str::slug($request->event),
            'file' => $filename,
            'desc' => $request->desc,
            'start_date' => $request->start,
            'end_date' => $request->end
        ]);

        return redirect()->to('organizations/'.$idorg.'/event')
        ->with('success','Organizations events updated successfully');
    }

    public function eventdestroy($idorg,$id)
    {
        # code...
        EventOrganizations::find($id)->delete();
        return redirect()->to('organizations/'.$idorg.'/event')
        ->with('success','Organizations events deleted successfully');
    }
}
