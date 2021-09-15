@extends('master')
@section('title', '- Award')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            <img style="height: 300px; width: 100%;" src="{{url('uploads/'.$award->award_logo)}}" alt="placeholder 960" class="img-fluid img-responsive" />
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        {{$award->description}}
    </div>
</div>
@endsection