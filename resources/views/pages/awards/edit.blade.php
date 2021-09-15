@extends('master')
@section('title', '- Awards')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Award</h2>
        <form method="POST" action="{{route('awards.update',$award->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="awardname">Nama Award</label>
                <input type="text" class="form-control  @error('awardname') is-invalid @enderror" value="{{$award->award_name}}" id="awardname" name="awardname" placeholder="Award">
                @error('awardname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Deksripsi</label>
                <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" cols="30" rows="10">{{$award->description}}</textarea>
                @error('desc')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $award->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file">Logo</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            @if(!empty($award->award_logo))
            <div class="form-group col-md-4">
                <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                    <img src='{{url("uploads/$award->award_logo")}}' class="img-fluid img-thumbnail" />
                </div>
            </div>
            @endif
            <div class="button-grup">
                <a href="{{route('awards.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection