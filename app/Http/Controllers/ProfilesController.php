<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Branchsport;

class ProfilesController extends Controller
{
    //
    public function index(){
        $branchs = Branchsport::get();
        return view('pages.profiles.show',compact('branchs'));
    }
    
    public function update(Request $request, $id)
    {
        $rules = [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'email'     => 'required|email',
        ];

        $messages = [
            'name.required'  => 'Firstname wajib diisi',
            'name.min'       => 'Firstname minimal 3 karakter',
            'name.required'  => 'Lastname wajib diisi',
            'name.min'       => 'Lastname minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $get = User::find($id);
        $filename = $get->profile_pic;
        $filename1 = $get->profile_ktp;

        if (!empty($request->file)) {
            
            File::delete(public_path("uploads/" . $get->profile_pic));
            $namefile = str_replace(' ', '_', pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
            $filename  = $namefile . '_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $filename);
        }

        if (!empty($request->filektp)) {
            File::delete(public_path("uploads/" . $get->profile_ktp));
            $namefile1= str_replace(' ','_',pathinfo($request->filektp->getClientOriginalName(),PATHINFO_FILENAME));
            $filename1  = $namefile1 . '_' . time() . '.' . $request->filektp->extension();
            $request->filektp->move(public_path('uploads'), $filename1);
        }

        // return dd($filename1);

        if (empty($request->pass)) {
            $pass = $get->password;
        } else {
            $pass = Hash::make($request->pass);
        }

        $user = User::find($id);
        $user->update([
            'name' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $pass,
            'no_ktp' => $request->ktp,
            'address' => $request->address,
            'profile_pic' => $filename,
            'profile_ktp' => $filename1,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully');
    }
}
