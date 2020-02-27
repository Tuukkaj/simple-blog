@extends('layouts.app')

@section("content")
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="/posts/{{$post->id}}">{{$post->title}}</a>

                @if(Auth::user()->isAdmin())
                    -
                    <a href="/posts/{{$post->id}}/edit">Edit</a>
                @endif
            </li>


        @endforeach
    </ul>

    @if(Auth::user()->isAdmin())
        <h2><a href="/posts/create">+ Create post</a></h2>
    @endif

@stop
