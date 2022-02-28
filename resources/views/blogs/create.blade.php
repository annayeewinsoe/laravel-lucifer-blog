@extends('layouts.app')

@section('content')

<div class="main">
  <div class="container">
    <h2 class="center">create a blog about lucifer</h2>
    {!! Form::open([
      'action'=>'App\Http\Controllers\BlogsController@store', 
      'method'=>'post',
      'enctype'=>'multipart/form-data'
    ]) !!}

    {{Form::label('title', 'title')}}
    {{Form::text('title', '')}}

    {{Form::label('body', 'body')}}
    {{Form::textarea('body', '')}}

    {{Form::file('img')}}

    {{Form::submit('Submit', ['class'=>'btn btn-333'])}}

    {!! Form::close() !!}
  </div>
</div>

@endsection