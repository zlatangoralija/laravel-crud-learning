@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>

    @endif

    <h1>Posts</h1>

    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Photo </th>
            <th>User </th>
            <th>Category </th>
            <th>Title</th>
            <th>Link</th>
            <th>Comments</th>
            <th>Created at</th>
            <th>Updated at</th>
          </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td><img src="{{$post->photo ? $post->photo->file : 'http://placehold.it/50x50'}}" height="50"></td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category ? $post->category->name : "No category"}}</td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a> </td>
                <td><a href="{{route('home.post', $post->slug)}}">View post</a> </td>
                <td><a href="{{route('admin.comments.show', $post->id)}}">View comment</a> </td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>

    @stop