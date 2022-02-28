@extends('layouts.app')

@section('content')
<div class="main">
  <div class="container">
    <img class="blog-img-xl" src="{{ url('/storage/blog_images/'.$blog->img) }}" alt="lucifer">
    <h2>{{ $blog->title }}</h2>
    <small>written by {{ $blog->user->name }}</small>
    <p>{{ $blog->body }}</p>
    <small>written on {{ $blog->created_at }}</small>

    @if(!Auth::guest())
    @if(Auth::user()->id == $blog->user_id)
    <a href="/blogs/{{ $blog->id }}/edit" class="btn btn-666">edit</a>

    {!! Form::open(['action'=>['App\Http\Controllers\BlogsController@destroy', $blog->id], 'method'=>'post']) !!}

    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('delete', ['class'=>'btn btn-red'])}}

    {!! Form::close() !!}
    @endif
    @endif

    <a href="/blogs" class="btn btn-333">go back</a>
  </div>
</div>
@endsection