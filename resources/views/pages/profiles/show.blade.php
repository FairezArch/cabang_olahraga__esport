@extends('master')
@section('title', '- Profile')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <div class="row">
            <div class="col-sm-3">
                <h2>Profile</h2>
            </div>
            <div class="col-sm-9 text-right">
                @if( Auth::check() && Auth::user()->hasRole('Atlet') ) 
                <a class="btn btn-primary" href="{{url('infoclub')}}">Info Club</a>
                @else
                &nbsp;
                @endif
            </div>
        </div>
        <form method="POST" action="{{route('profile.update',Auth::user()->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" value="{{Auth::user()->name}}" id="firstname" name="firstname" placeholder="Firstname">
                    @error('firstname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" value="{{Auth::user()->lastname}}" id="lastname" name="lastname" placeholder="Lastname">
                    @error('lastname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" id="inputEmail4" placeholder="Email" name="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="ktp">No KTP</label>
                <input type="text" class="form-control" value="{{Auth::user()->no_ktp}}" id="ktp" name="ktp">
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <textarea class="form-control" name="address" id="address" cols="30" rows="10">{{Auth::user()->address}}</textarea>
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == Auth::user()->cabang_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
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
                @if(!empty(Auth::user()->profile_pic))
                <div class="form-group col-md-4">
                    <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                        <img src='{{url("uploads/".Auth::user()->profile_pic)}}' class="img-fluid img-thumbnail" />
                    </div>
                </div>
                @endif
                @if(!empty(Auth::user()->profile_ktp))
                <div class="form-group col-md-4">
                    <div class="show-image d-inline-block" id="show-image" style="width: 150px; height: auto;">
                        <img src='{{url("uploads/".Auth::user()->profile_ktp)}}' class="img-fluid img-thumbnail" />
                    </div>
                </div>
                @endif
            </div>
            <div class="button-grup">
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection