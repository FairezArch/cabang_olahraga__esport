@extends('master')
@section('title', '- Cabang')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Cabang</h2>
        <form method="POST" action="{{route('branchs.update',$branch->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="clubname">Nama Cabang</label>
                <input type="text" value="{{ $branch->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Cabang">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="button-grup">
                <a href="{{route('branchs.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection