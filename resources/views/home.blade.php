@extends('layouts.app')

@section('content')
<div class="main">
    <div class="container">
        <div class="card-body">
            <h2 class="card-header">{{ __('Dashboard') }}</h2>

            <div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
            <div class="panel">
                <div><a href="/blogs/create">create a blog</a></div>
                <div><a href="/blogs">view blogs</a></div>
            </div>

            @if(count($blogs) > 0)
            <table id="my-blogs">
                <thead>
                    <tr>
                        <th class="w-70">my blogs</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td><a href="/blogs/{{ $blog->id }}/edit" class="btn btn-666">edit</a></td>
                        <td>
                            {!! Form::open(['action'=>['App\Http\Controllers\BlogsController@destroy', $blog->id], 'method'=>'post']) !!}

                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('delete', ['class'=>'btn btn-red'])}}

                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>you don't have any blogs yet</p>
            @endif
        </div>
    </div>
</div>
@endsection