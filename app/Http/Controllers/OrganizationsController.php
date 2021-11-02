<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Organization;
use App\Models\User;
use App\Models\TeamModel;
use App\Models\EventOrganizations;
use App\Models\Branchsport;

class OrganizationsController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:organizations-list|organizations-create|organizations-edit|organizations-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($club_id)
    {
        # code...
        $lists = DB::table('origanizations')
                ->join('clubs','origanizations.club_id','clubs.id')  
                ->join('users','origanizations.user_id','users.id')
                ->select('origanizations.id','users.id as user_id','clubs.iduser as club_iduser','users.cabang_id','users.name',
                        'users.lastname','users.address','users.no_ktp','users.profile_ktp','users.profile_pic','users.email')
                ->where('origanizations.club_id',$club_id)
                ->where('origanizations.cabang_id',auth::user()->cabang_id)
                ->whereNull('origanizations.deleted_at')
                ->paginate(5);
        return view('pages.clubs.organizations.index',compact('lists','club_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($club_id)
    {
        # code...
        
        $users = DB::table('users')->join('model_has_roles','users.id','model_has_roles.model_id')
                ->select('users.*','model_has_roles.role_id','model_has_roles.model_id')
                ->where('model_has_roles.role_id',4)->paginate(5);
        $teams = TeamModel::get();
        $branchs = Branchsport::get();
        return view('pages.clubs.organizations.add',compact('users','teams','branchs','club_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $club_id)
    {
        # code...
        $rules = [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email|unique:users',
            'pass'      => 'required|min:3',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
            'filektp'   => 'required|file|mimes:jpg,jpeg,bmp,png'
        ];
  
        $messages = [
            'firstname.required'  => 'Firstname wajib diisi',
            'firstname.min'       => 'Firstname minimal 3 karakter',
            'lastname.required'  => 'Lastname wajib diisi',
            'lastname.min'       => 'Lastname minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'pass.required'  => 'Password wajib diisi',
            'pass.min'       => 'Password minimal 3 karakter',
            'file.required'  => 'Foto profile wajib diupload',
            'filektp.required'  => 'Foto KTP wajib diupload'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
          
        $namefile = str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);

        $namefile1= str_replace(' ','_',pathinfo($request->filektp->getClientOriginalName(),PATHINFO_FILENAME));
        $filename1  = $namefile1.'_'.time().'.'.$request->filektp->extension();  
        $request->filektp->move(public_path('uploads'), $filename1);

        $role = Role::find(4);
        $user = User::create([
            'name'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'password'=>Hash::make($request->pass),
            'no_ktp'=>$request->ktp,
            'address'=>$request->address,
            'profile_pic'=>$filename,
            'profile_ktp'=>$filename1,
            'active'=>99,
            'active_member'=>0,
            'cabang_id'=>$request->branch
        ]);
        $user->assignRole($role->name);

        // $teams = json_encode($request->listeam);
        Organization::create([
            'club_id' => $club_id,
            'user_id' => $user->id,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->to('clubs/'.$club_id.'/organizations')
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
    public function edit($club_id, $id)
    {
        # code...
        $organization = Organization::find($id);
        $user = User::find($organization->user_id);
        // $teams = TeamModel::get();
        // $memberarr = [];
        // $de = json_decode($organization->team_name);
        // foreach($de as $member){$memberarr[] = $member;} 
        $branchs = Branchsport::get();
        return view('pages.clubs.organizations.edit',compact('organization','user','branchs','club_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $club_id, $id)
    {
        # code...
        $rules = [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email|unique:users,email,'.$id,
        ];
  
        $messages = [
            'firstname.required'  => 'Firstname wajib diisi',
            'firstname.min'       => 'Firstname minimal 3 karakter',
            'lastname.required'  => 'Lastname wajib diisi',
            'lastname.min'       => 'Lastname minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $teams = json_encode($request->listeam);
        $organ = Organization::find($id);
        $user = User::find($organ->user_id);

        $filename = $user->profile_pic;
        $filename1 = $user->profile_ktp;

        if(!empty($request->file)){
            File::delete(public_path("uploads/".$user->profile_pic));
            $namefile = str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }

        if(!empty($request->filektp)){
            File::delete(public_path("uploads/".$user->profile_ktp));
            $namefile1= str_replace(' ','_',pathinfo($request->filektp->getClientOriginalName(),PATHINFO_FILENAME));
            $filename1  = $namefile1.'_'.time().'.'.$request->filektp->extension();  
            $request->filektp->move(public_path('uploads'), $filename1);
        }

        if(empty($request->pass)){
            $pass = $user->password;
        }else{
            $pass = Hash::make($request->pass);
        }

        $user->update([
            'name'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'password'=>$pass,
            'no_ktp'=>$request->ktp,
            'address'=>$request->address,
            'profile_pic'=>$filename,
            'profile_ktp'=>$filename1,
            'active'=>99,
            'active_member'=>0,
            'cabang_id'=>$request->branch
        ]);

        $organ->update([
            'club_id' => $club_id,
            'user_id' => $user->id,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->to('clubs/'.$club_id.'/organizations')
        ->with('success','Organizations updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($club_id, $id)
    {
        # code...
        // $event = EventOrganizations::where('idorganization',$id)->get();
        // if(!empty($event)){
        //     EventOrganizations::where('idorganization',$id)->delete();
        // }
        
        $org = Organization::find($id);
        $user= User::find($org->user_id);
        DB::table('model_has_roles')->where('model_id',$org->user_id)->delete();
        $user->delete();
        $org->delete();

        return redirect()->to('clubs/'.$club_id.'/organizations')
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
