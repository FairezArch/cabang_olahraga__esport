@extends('master')
@section('title', '- Organizations Event')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Organizations Event</h2>
        <form method="POST" action="{{url('organizations/'.$idorg.'/event/store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idorg" id="idorg" value="{{$idorg}}">
            <div class="form-group">
                <label for="event">Nama Event</label>
                <input type="text" value="{{old('event')}}" class="form-control @error('event') is-invalid @enderror" id="event" name="event" placeholder="Nama Event">
                @error('event')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('start') is-invalid @enderror" id="start" name="start">
                    @error('start')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Tanggal Berakhir</label>
                    <input type="date" class="form-control @error('end') is-invalid @enderror" id="end" name="end">
                    @error('end')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="file">Gambar Event Organization</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="button-grup">
                <a href="{{url('organizations/'.$idorg.'/event')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection