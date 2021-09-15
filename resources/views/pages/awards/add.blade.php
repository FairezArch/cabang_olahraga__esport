@extends('master')
@section('title', '- Awards')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Award</h2>
        <form method="POST" action="{{route('awards.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="awardname">Nama Award</label>
                <input type="text" value="{{ old('awardname') }}" class="form-control @error('awardname') is-invalid @enderror" id="awardname" name="awardname" placeholder="Award">
                @error('awardname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Deksripsi</label>
                <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" cols="30" rows="10"></textarea>
                @error('desc')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group ">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="file">Logo</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                    @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="button-grup">
                <a href="{{route('awards.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection