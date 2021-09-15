@extends('master')
@section('title', '- Game')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            <img style="height: 300px; width: 100%;" src="{{url('uploads/'.$game->image_game)}}" alt="placeholder 960" class="img-fluid img-responsive" />
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        {{$game->description}}
    </div>
    <div class="card-title">
        {{$game->rules}}
    </div>
</div>
@endsection