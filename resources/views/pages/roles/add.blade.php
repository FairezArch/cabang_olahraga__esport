@extends('master')
@section('title', '- Roles')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Role</h2>
        <form method="POST" action="{{route('roles.insert')}}">
            @csrf
            <div class="form-group">
                <label for="name">Role</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" aria-describedby="name" placeholder="Peran">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center border cnter_table" scope="col">Permission</th>
                                <th colspan="4" class="text-center" scope="col">Open Permission</th>
                            </tr>
                            <tr>
                                <td class="text-center border" style="width: 150px;" scope="col">List</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Create</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Update</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parent_menu as $menu)
                            <tr>
                                <td scope="row">{{$menu->name_menu}}</td>
                                @foreach($permissions as $permission)
                                @if($menu->id == $permission->parent)
                                <td class="text-center" scope="row">
                                    <input type="checkbox" id="click" class="@error('permission') is-invalid @enderror" id="permission" name="permission[]" value="{{$permission->id}}">
                                </td>
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                @error('permission')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="button-grup">
                <a href="{{route('roles')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection