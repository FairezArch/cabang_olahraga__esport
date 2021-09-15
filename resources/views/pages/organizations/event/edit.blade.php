@extends('master')
@section('title', '- Organizations Event')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Organizations Event</h2>
        <form method="POST" action="{{url('organizations/'.$idorg.'/event/update/'.$eventorg->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="idorg" id="idorg" value="{{$idorg}}">
            <div class="form-group">
                <label for="event">Nama Event</label>
                <input type="text" class="form-control @error('event') is-invalid @enderror" id="event" value="{{$eventorg->event_name}}" name="event" placeholder="Nama Event">
                @error('event')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start" value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $eventorg->start_date)->format('Y-m-d')}}" name="start">
                    @error('start')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Tanggal Berakhir</label>
                    <input type="date" class="form-control" id="end" value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $eventorg->end_date)->format('Y-m-d')}}" name="end">
                    @error('end')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10">{{$eventorg->desc}}</textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="file">Gambar Event Organization</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if(!empty($eventorg->file))
            <div class="form-group col-md-4">
                <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                    <img src='{{url("uploads/$eventorg->file")}}' class="img-fluid img-thumbnail" />
                </div>
            </div>
            @endif
            <div class="button-grup">
                <a href="{{url('organizations/'.$idorg.'/event')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection