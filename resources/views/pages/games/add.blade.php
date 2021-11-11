@extends('master')
@section('title', '- Game')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Game</h2>
        <form method="POST" action="{{route('games.insert')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Game</label>
                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name" placeholder="Nama Game">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Deskripsi</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" rows="3" name="desc"></textarea>
                @error('desc')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="rule">Rule</label>
                <textarea class="form-control @error('rule') is-invalid @enderror" id="rule" rows="3" name="rule"></textarea>
                @error('rule')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="file">Gambar Game</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" aria-describedby="file">
                    @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="filelogo">Logo Game</label>
                    <input type="file" class="form-control @error('filelogo') is-invalid @enderror" id="filelogo" name="filelogo" aria-describedby="filelogo">
                    @error('filelogo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="show-image d-none" id="show-image"></div>
            </div>
            <div class="button-grup">
                <a href="{{route('games')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection