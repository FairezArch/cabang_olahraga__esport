@extends('master')
@section('title', '- Organizations')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Organization</h2>
        <form method="POST" action="{{route('organizations.update',$organization->id)}}">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="organizations">Nama Organization</label>
                    <input type="text" class="form-control" id="organizations" value="{{$organization->name_club}}" name="organizations" placeholder="Nama organizations">
                    @error('organizations')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="pengurus">Pengurus</label>
                    <select name="pengurus" id="pengurus" class="form-control @error('pengurus') is-invalid @enderror">
                        <option value="">Select An Option</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}" {{ ($user->id == $organization->owner_club) ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error('pengurus')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listeam">List Team</label>
                    <select name="listeam[]" id="listeam" class="form-control @error('listeam') is-invalid @enderror" multiple="multiple">
                        <option value="">Select An Option</option>
                        @foreach($teams as $team)
                        <option value="{{$team->id}}" {{ in_array($team->id,$memberarr) ? 'selected' : ''}}>{{$team->team_name}}</option>
                        @endforeach
                    </select>
                    @error('listeam')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="branch">Cabang</label>
                    <select name="branch" id="branch" class="form-control">
                        @foreach($branchs as $branch)
                        <option value="{{$branch->id}}" {{($branch->id == $organization->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="desc">Diskripsi</label>
                <textarea id="desc" class="form-control" name="desc" cols="30" rows="10">{{ $organization->desc }}</textarea>
            </div>
            <div class="button-grup">
                <a href="{{route('organizations.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@section('script-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    var users = {!!json_encode($organization->toArray())!!};
    $('#listeam').select2({
        width: '100%',
        multiple: true,
        placeholder: "Select an Option",
    }).trigger('change.select2');
</script>
@endsection
@endsection