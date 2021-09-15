@extends('master')
@section('title', '- Member')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Select Member</h2>
        <form method="POST" action="{{route('members.selectadd')}}">
            @csrf
            <div class="form-group">
                <label for="selectuser">User</label>
                <select name="selectuser" id="selectuser" class="form-control">
                    @foreach($lists as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                    @endforeach
                </select>
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
                <a href="{{route('members.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection