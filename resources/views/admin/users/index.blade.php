@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>

        @endif

    @if(Session::has('edited_user'))
        <p class="bg-info">{{session('edited_user')}}</p>

    @endif

    <h1>Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                <td><img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/50x50'}}" height="50"></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
              </tr>
          @endforeach
        @endif
        </tbody>
    </table>
@stop

