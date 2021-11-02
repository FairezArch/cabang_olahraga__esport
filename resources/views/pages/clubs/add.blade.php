@extends('master')
@section('title', '- Clubs')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Club</h2>
        <form method="POST" action="{{route('clubs.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="clubname">Nama Club</label>
                <input type="text" value="{{ old('clubname') }}" class="form-control @error('clubname') is-invalid @enderror" id="clubname" name="clubname" placeholder="Nama Club">
                @error('clubname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="user">Kepala Club</label>
                <select name="user" id="user" class="form-control @error('user') is-invalid @enderror">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('user')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="cover">Gambar</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
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
            <div class="button-grup">
                <a href="{{route('clubs.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@section('script-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    $('#listeam').select2({
        width: '100%',
        multiple: true,
        placeholder: "Select an Option",
        allowClear: true
    });
</script>
@endsection
@endsection