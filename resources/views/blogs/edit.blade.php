@extends('layouts.app')

@section('content')

<div class="main">
  <div class="container">
    <h2 class="center">edit blog</h2>
    {!! Form::open([
      'action'=>['App\Http\Controllers\BlogsController@update', $blog->id],
      'method'=>'put',
      'enctype'=>'multipart/form-data'
    ]) !!}

    {{Form::label('title', 'title')}}
    {{Form::text('title', $blog->title)}}

    {{Form::label('body', 'body')}}
    {{Form::textarea('body', $blog->body)}}

    {{Form::file('img')}}

    {{Form::submit('Submit', ['class'=>'btn btn-333'])}}

    {!! Form::close() !!}
  </div>
</div>

@endsection