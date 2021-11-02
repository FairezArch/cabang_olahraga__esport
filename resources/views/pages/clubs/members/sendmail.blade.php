@extends('master')
@section('title', '- Member')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Select Member</h2>
        <form method="POST" action="{{route('members.sendmail')}}">
            @csrf
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" name="mail" id="mail" class="form-control" placeholder="email@mail.com">
            </div>
            <div class="form-group">
                <label for="message">Pesan</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="button-grup">
                <a href="{{route('members.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection