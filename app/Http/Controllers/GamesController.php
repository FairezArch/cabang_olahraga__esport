<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GamesModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:games-list|games-create|games-edit|games-delete']);
    }

    public function index()
    {
        # code...
        $games = GamesModel::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.games.index',compact('games'));
    }

    public function create()
    {
        # code...
        $branchs = Branchsport::get();
        return view('pages.games.add',compact('branchs'));
    }


    public function store(Request $request)
    {
        # code...

        $rules = [
            'name'     => 'required|min:3',
            'desc'     => 'required|min:3',
            'rule'     => 'required|min:3',
            'file'     => 'required|file|mimes:jpg,jpeg,bmp,png',
            'filelogo' => 'required|file|mimes:jpg,jpeg,bmp,png'
            
        ];
  
        $messages = [
            'name.required'  => 'Nama Game wajib diisi',
            'name.min'       => 'Nama Game minimal 3 karakter',
            'desc.required'  => 'Deskripsi wajib diisi',
            'desc.min'       => 'Deskripsi minimal 3 karakter',
            'rule.required'  => 'Peraturan wajib diisi',
            'rule.min'       => 'Peraturan minimal 3 karakter',
            'file.required'  => 'Foto game wajib diupload',
            'filelogo.required'  => 'Logo game wajib diupload',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $namefile= str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);

        $namefile1= str_replace(' ','_',pathinfo($request->filelogo->getClientOriginalName(),PATHINFO_FILENAME));
        $filename1  = $namefile1.'_'.time().'.'.$request->filelogo->extension();  
        $request->filelogo->move(public_path('uploads'), $filename1);

        GamesModel::create([
                            'game_name' => $request->name,
                            'slug' => Str::slug($request->name),
                            'game_description' => $request->desc,
                            'image_game' => $filename,
                            'logo_game' => $filename1,
                            'rules' => $request->rule,
                            'cabang_id'=>$request->branch
                        ]);
        return redirect()->route('games')
        ->with('success','Games created successfully');
    }

    public function show($id)
    {
        # code...
        $games = GamesModel::find($id);
        $branchs = Branchsport::get();
        return view('pages.games.edit', compact('games','branchs'));
    }

    public function view($id)
    {
        # code...
    }


    public function update(Request $request, $id)
    {
        # code...
        $rules = [
            'name'     => 'required|min:3',
            'desc'     => 'required|min:3',
            'rule'     => 'required|min:3',
            
        ];
  
        $messages = [
            'name.required'  => 'Nama Game wajib diisi',
            'name.min'       => 'Nama Game minimal 3 karakter',
            'desc.required'  => 'Deskripsi wajib diisi',
            'desc.min'       => 'Deskripsi minimal 3 karakter',
            'rule.required'  => 'Peraturan wajib diisi',
            'rule.min'       => 'Peraturan minimal 3 karakter',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $games = GamesModel::find($id);
        $filename = $games->image_game;
        $filename1 = $games->logo_game;

        if(!empty($request->file)){
            File::delete(public_path("uploads/".$games->image_game));
            $namefile = str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }

        if(!empty($request->filelogo)){
            File::delete(public_path("uploads/".$games->logo_game));
            $namefile1= str_replace(' ','_',pathinfo($request->filelogo->getClientOriginalName(),PATHINFO_FILENAME));
            $filename1  = $namefile1.'_'.time().'.'.$request->filelogo->extension();  
            $request->filelogo->move(public_path('uploads'), $filename1);
        }

        $games->update([
            'game_name' => $request->name,
            'slug' => Str::slug($request->name),
            'game_description' => $request->desc,
            'image_game' => $filename,
            'logo_game' => $filename1,
            'rules' => $request->rule,
            'cabang_id'=>$request->branch
        ]);
       
        return redirect()->route('games')
        ->with('success','Games updated successfully');
    }

    
    public function destroy($id)
    {
        # code...
        $games = GamesModel::find($id);
        if(!empty($games->image_game)){
            File::delete(public_path("uploads/".$games->image_game));
        }
        $games->delete();
        
        return redirect()->route('games')
        ->with('success','Games deleted successfully');
    }
}
