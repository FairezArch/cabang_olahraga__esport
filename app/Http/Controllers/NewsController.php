<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Branchsport;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware(['permission:news-list|news-create|news-edit|news-delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = News::where('cabang_id',auth::user()->cabang_id)->paginate(5);
        return view('pages.news.index',compact('lists'));

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
        return view('pages.news.add',compact('branchs'));
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
            'title'     => 'required|min:3',
            'content'   => 'required|min:5',
            'file'      => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
  
        $messages = [
            'title.required'   => 'Judul wajib diisi',
            'title.min'        => 'Judul minimal 3 karakter',
            'content.required' => 'Konten wajib diisi',
            'content.min'      => 'Konten minimal 3 karakter',
            'file.required'    => 'Gambar harap diupload'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
        $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
        $request->file->move(public_path('uploads'), $filename);
       
        News::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'file'=>$filename,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('news.index')
        ->with('success','news created successfully');
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
        $news = News::find($id);
        $branchs = Branchsport::get();
        return view('pages.news.edit',compact('news','branchs'));
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
        $rules = [
            'title'     => 'required|min:3',
            'content'   => 'required|min:5',
        ];
  
        $messages = [
            'title.required'   => 'Judul wajib diisi',
            'title.min'        => 'Judul minimal 3 karakter',
            'content.required' => 'Konten wajib diisi',
            'content.min'      => 'Konten minimal 3 karakter',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = News::find($id);
        $filename = $news->file;

        if(!empty($request->file)){
            File::delete(public_path("uploads/".$news->file));
            $namefile = str_replace(' ','_',$request->file->getClientOriginalName());
            $filename  = $namefile.'_'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }
        
        $news->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'file'=>$filename,
            'cabang_id'=>$request->branch
        ]);

        return redirect()->route('news.index')
        ->with('success','news created successfully');
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
        // return dd('dasdasdsadas');
        News::find($id)->delete();
        return redirect()->route('news.index')
                        ->with('success','News deleted successfully');
    }
}
