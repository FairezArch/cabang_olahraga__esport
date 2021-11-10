@extends('master')
@section('title', '- Events')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Event</h2>
        <form method="POST" action="{{route('events.update',$event->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Event</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$event->event_name)}}" id="name" name="name" placeholder="Nama Event">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date',\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('Y-m-d'))}}" id="date" name="date">
                @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end">Tanggal Selesai</label>
                <input type="date" class="form-control @error('end') is-invalid @enderror" value="{{old('date',\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('Y-m-d'))}}" id="end" name="end">
                @error('end')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $event->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10">{{$event->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="file">Gambar</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                @if(!empty($event->file))
                <div class="form-group col-md-4">
                    <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                        <img src='{{url("uploads/$event->file")}}' class="img-fluid img-thumbnail" />
                    </div>
                </div>
                @endif
            </div>
            <div class="button-grup">
                <a href="{{route('events.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection