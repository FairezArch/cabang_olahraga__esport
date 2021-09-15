<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Branchsport;

class RegisterMember extends Controller
{
    //
    public function index()
    {
        # code...
        $branchs = Branchsport::get();
        return view('register',compact('branchs'));
    }

    public function add(Request $request)
    {
        # code...
        $rules = [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email|unique:users',
            'pass'      => 'required|min:3',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
            'filektp'   => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
  
        $messages = [
            'name.required'  => 'Firstname wajib diisi',
            'name.min'       => 'Firstname minimal 3 karakter',
            'name.required'  => 'Lastname wajib diisi',
            'name.min'       => 'Lastname minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'pass.required'  => 'Password wajib diisi',
            'pass.min'       => 'Password minimal 3 karakter',
            'file.required'  => 'Foto profile wajib diupload',
            'filektp.required'  => 'Foto KTP wajib diupload',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
   
        $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);
        
        $namefile1= str_replace(' ','_',$request->filektp->getClientOriginalName());
        $filename1  = $namefile1.'_'.time().'.'.$request->filektp->extension();  
        $request->filektp->move(public_path('uploads'), $filename1);

        $role = Role::find(8);
        $user = User::create([
            'name'=>$request->firstname,
            'lastname'=>$request->lastname,
            'address'=>$request->firstname,
            'no_ktp'=>$request->ktp,
            'profile_ktp'=>$filename,
            'profile_pic'=>$filename1,
            'email'=>$request->email,
            'active'=>1,
            'password'=> Hash::make($request->password),
            'cabang_id'=>$request->branch
        ]);
        $insertid = $user->id;
        Member::create([
            'iduser'=>$insertid,
            'status'=>1,
        ]);
        $user->assignRole($role->name);

        return redirect('/');
    }
}
