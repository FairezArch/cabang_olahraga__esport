@extends('master')
@section('title', '- Clubs')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Club</h2>
        <form method="POST" action="{{route('clubs.update',$club->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="clubname">Nama Club</label>
                <input type="text" class="form-control @error('clubname') is-invalid @enderror" id="clubname" value="{{old('clubname',$club->club_name)}}" name="clubname" placeholder="Nama Club">
                @error('clubname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="user">Kepala Club</label>
                <select name="user" id="user" class="form-control @error('user') is-invalid @enderror">
                    @foreach($users as $user)
                    <option value="{{$user->id}}" {{ ($user->id == $club->iduser) ? 'selected' : '' }}>{{$user->name}}</option>
                    @endforeach
                </select>
                @error('user')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $club->cabang_id) ? 'selected="selected"' : ''}} >{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="button-grup">
                <a href="{{route('clubs.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection