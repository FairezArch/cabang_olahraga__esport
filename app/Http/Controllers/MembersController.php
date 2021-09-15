<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{

    public function __construct()
    {
        # code...
        $this->middleware(['permission:members-list|members-create|members-edit|members-delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = DB::table('users')
            ->join('members', 'users.id', 'members.iduser')
            ->select('users.*', 'members.*', 'members.id as member_id')
            ->where('users.active_member', 1)
            ->where('members.status', 1)
            ->where('members.deleted_at', null)
            ->where('cabang_id',auth::user()->cabang_id)
            ->paginate(5);
        // $lists = Member::paginate(5);
        return view('pages.members.index', compact('lists'));
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
        return view('pages.members.add',compact('branchs'));
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
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email|unique:users',
            'pass'      => 'required|min:3',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
            'filektp'   => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];

        $messages = [
            'firstname.required'  => 'Firstname wajib diisi',
            'firstname.min'       => 'Firstname minimal 3 karakter',
            'lastname.required'   => 'Lastname wajib diisi',
            'lastname.min'        => 'Lastname minimal 3 karakter',
            'email.required'      => 'Email wajib diisi',
            'pass.required'       => 'Password wajib diisi',
            'pass.min'            => 'Password minimal 3 karakter',
            'file.required'       => 'Foto profile wajib diupload',
            'filektp.required'    => 'Foto KTP wajib diupload',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $namefile = str_replace(' ', '_', $request->file->getClientOriginalName());
        $filename  = $namefile . '_' . time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $filename);

        $namefile1 = str_replace(' ', '_', $request->filektp->getClientOriginalName());
        $filename1  = $namefile1 . '_' . time() . '.' . $request->filektp->extension();
        $request->filektp->move(public_path('uploads'), $filename1);

        $role = Role::find(5);
        $user = User::create([
            'name' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->pass),
            'no_ktp' => $request->ktp,
            'address' => $request->address,
            'profile_pic' => $filename,
            'profile_ktp' => $filename1,
            'active' => 1,
            'active_member' => 1,
            'cabang_id'=>$request->branch
        ]);
        $insertid = $user->id;
        Member::create([
            'iduser' => $insertid,
            'status' => 1,
        ]);
        $user->assignRole($role->name);

        return redirect()->route('members.index')
            ->with('success', 'member created successfully');
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
        $member = Member::find($id);
        $user = User::find($member->iduser);
        $branchs = Branchsport::get();
        return view('pages.members.edit', compact('user','branchs'));
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
        // return dd($id);
        $rules = [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email|unique:users,email,'.$id,
        ];

        $messages = [
            'firstname.required'  => 'Firstname wajib diisi',
            'firstname.min'       => 'Firstname minimal 3 karakter',
            'lastname.required'   => 'Lastname wajib diisi',
            'lastname.min'        => 'Lastname minimal 3 karakter',
            'email.required'      => 'Email wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        $filename = $user->profile_pic;
        $filename1 = $user->profile_ktp;

        if (!empty($request->file)) {
            File::delete(public_path("uploads/" . $user->profile_pic));

            $namefile = str_replace(' ', '_', $request->file->getClientOriginalName());
            $filename  = $namefile . '_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $filename);
        }

        if (!empty($request->filektp)) {
            File::delete(public_path("uploads/" . $user->profile_ktp));

            $namefile1 = str_replace(' ', '_', $request->filektp->getClientOriginalName());
            $filename1  = $namefile1 . '_' . time() . '.' . $request->filektp->extension();
            $request->filektp->move(public_path('uploads'), $filename1);
        }

        if (empty($request->pass)) {
            $pass = $user->password;
        } else {
            $pass = Hash::make($request->pass);
        }

        $user->update([
            'name' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $pass,
            'no_ktp' => $request->ktp,
            'address' => $request->address,
            'profile_pic' => $filename,
            'profile_ktp' => $filename1,
            'active' => 1,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('members.index')
            ->with('success', 'member updated successfully');
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
        $member = Member::find($id);
        $user = User::find($member->iduser);
        DB::table('model_has_roles')->where('model_id', $member->iduser)->delete();
        $role = Role::find(2);
        $user->assignRole($role->name);
        $user->update(['active_member' => 0]);
        $member->delete();
        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully');
    }

    public function mail()
    {
        # code...
        return view('pages.members.sendmail');
    }

    public function sendmail(Request $request)
    {
        # code...
        $details = [
            'title' => 'Hallo Calon Member',
            'body' => $request->message
        ];

        try {
            \Mail::to($request->mail)->send(new \App\Mail\EsportMail($details));
        } catch (\Exception $e) {
            echo "Email gagal dikirim karena $e.";
        }

        return redirect()->route('members.index')
            ->with('success', 'Members send successfully');
    }

    public function selectmember()
    {
        # code...
        $lists = User::where('active', 1)->where('active_member', 0)->get();
        $branchs = Branchsport::get();
        return view('pages.members.select', compact('lists','branchs'));
    }

    public function directjoin(Request $request)
    {
        # code...
        Member::create([
            'iduser' => $request->selectuser,
            'status' => 1,
        ]);
        $role = Role::find(5);
        $user = User::find($request->selectuser);
        $user->update(['active_member' => 1,'cabang_id'=>$request->branch]);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($role->name);

        return redirect()->route('members.index')
            ->with('success', 'Members has been join to member');
    }
}
