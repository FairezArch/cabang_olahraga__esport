@extends('master')
@section('title', '- Event')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            <img style="height: 300px; width: 100%;" src="{{url('uploads/'.$event->file)}}" alt="placeholder 960" class="img-fluid img-responsive" />
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        {{$event->description}}
    </div>
    <div class="card-body text-center">
        <div class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            Join Event!
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <input type="hidden" name="clubData" id="clubData" data-json="">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Segera Daftarkan Team Andalan Mu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('dashboard/event/'.$event->slug.'/joinevent') }}" class="m-1">
                @csrf
                <div class="modal-body">
                    <select name="teamselect" id="teamselect" class="form-control">
                        @foreach($lists as $list)
                        <option value="{{$list->teamId}}">{{$list->team_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Join Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('script-footer')

@endsection
@endsection