@extends('master')
@section('title', '- Club Participation Events')
@section('content')
<div class="container-fluid">
    <div class="wrapper-table p-3 bg-white rounded">
        <div class="w-100 mt-3 mb-3">
            <h2>Partisipasi</h2>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nama Tim</th>
                        <th>Club</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $list)
                    <tr>
                        <td>{{ $list-> team_name}}</td>
                        <td>{{ $list-> club_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $lists->links() }}
            </div>
        </div>
    </div>
    @endsection