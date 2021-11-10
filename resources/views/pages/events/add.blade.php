@extends('master')
@section('title', '- Events')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Event</h2>
        <form method="POST" action="{{route('events.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Event</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Event" autofocus />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}">
                @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end">Tanggal Selesai</label>
                <input type="date" class="form-control @error('end') is-invalid @enderror" id="end" name="end" value="{{ old('end') }}">
                @error('end')
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
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="file">Gambar</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="button-grup">
                <a href="{{route('events.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection