@extends('layouts.app')

@section('content')
<div class="main">
  <div class="container">
    <a href="/blogs/create" class="btn btn-333">create a blog</a>

    @if(count($blogs) > 0)
    @foreach($blogs as $blog)
    <div class="card">
      <a href="/blogs/{{ $blog->id }}">
        <div>
          <h4>{{ $blog->title }}</h4>
          <small>written by {{ $blog->user->name }}</small>
          <img class="blog-img" src="{{ url('/storage/blog_images/'.$blog->img) }}" alt="lucifer">
        </div>
      </a>
    </div>
    @endforeach

    @else
    <p>No blog found.</p>
    @endif
  </div>
</div>
@endsection