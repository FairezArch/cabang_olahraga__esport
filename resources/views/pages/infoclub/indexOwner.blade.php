@extends('master')
@section('title', '- Info Club')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        @foreach($lists as $club)
        <h3>{{ $club->club_name }}</h3>
        <div class="mt-4">
            <div class="list">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="{{asset('uploads/'.$club->club_file)}}" class="card-img-top img-thumnail" style="height: 250px;" alt="...">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title">{{$club->club_name}}</h4>
                                <h5 class="card-text">
                                    Pemilik Club - {{ $club->owner_name.' '.$club->owner_lastname }}
                                </h5>
                                <p class="card-text">{{$club->club_desc}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sublist mt-4">
                <h4>Team</h4>
                <div class="content-team">
                    <div class="row">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-6 text-center">
                            <img src="{{asset('uploads/'.$club->team_file)}}" alt="..." class="rounded-circle w-50" style="height: 250px;">
                        </div>
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                    </div>
                    <div class="title-team text-center mt-2">
                        <h5 class="badge badge-success rounded p-2">{{$club->team_name}}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection