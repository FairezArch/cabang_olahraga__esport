@extends('master')
@section('title', '- Club')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            <img style="height: 300px; width: 100%;" src="{{url('uploads/'.$club->file)}}" alt="placeholder 960" class="img-fluid img-responsive" />
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        {{$club->description}}
    </div>
    <div class="card-body text-center">
        <form method="POST" action="{{url('dashboard/joinClub/'.$club->slug.'/insert')}}" class="m-1">
            {{ csrf_field() }}
            <button class="rounded m-2 btn btn-info text-light p-2">Join Now!</button>
        </form>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
</div>
@endsection