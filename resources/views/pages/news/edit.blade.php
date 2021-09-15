@extends('master')
@section('title', '- News')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit News</h2>
        <form method="POST" action="{{route('news.update',$news->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$news->title}}" placeholder="Judul">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" cols="30" rows="10">{{$news->content}}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="file">Gambar</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
            </div>
            @if(!empty($news->file))
            <div class="form-group col-md-4">
                <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                    <img src='{{url("uploads/$news->file")}}' class="img-fluid img-thumbnail" />
                </div>
            </div>
            @endif
            <div class="form-group col-md-4">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $news->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="button-grup">
                <a href="{{route('news.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@section('script-footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    var konten = document.getElementById("content");
    CKEDITOR.replace(konten, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection
@endsection