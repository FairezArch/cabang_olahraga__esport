@extends('master')
@section('title', '- Member')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Member</h2>
        <form method="POST" action="{{url('clubs/'.$club_id.'/members/edit/'.$user->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{$user->name}}" id="firstname" name="firstname" placeholder="Firstname">
                    @error('firstname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{$user->lastname}}" id="lastname" name="lastname" placeholder="Lastname">
                    @error('lastname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" id="email" placeholder="Email" name="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="ktp">No KTP</label>
                <input type="text" class="form-control" value="{{$user->no_ktp}}" id="ktp" name="ktp">
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" value="{{$user->address}}" id="inputAddress" name="address" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $user->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="file">Foto Profile</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <div class="form-group col-md-4">
                    <label for="filektp">Foto KTP</label>
                    <input type="file" class="form-control" id="filektp" name="filektp">
                </div>
            </div>
            <div class="form-row">
                @if(!empty($user->profile_pic))
                <div class="form-group col-md-4">
                    <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                        <img src='{{url("uploads/$user->profile_pic")}}' class="img-fluid img-thumbnail" />
                    </div>
                </div>
                @endif
                @if(!empty($user->profile_ktp))
                <div class="form-group col-md-4">
                    <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                        <img src='{{url("uploads/$user->profile_ktp")}}' class="img-fluid img-thumbnail" />
                    </div>
                </div>
                @endif
            </div>
            <div class="button-grup">
                <a href="{{url('clubs/'.$club_id.'/members')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection