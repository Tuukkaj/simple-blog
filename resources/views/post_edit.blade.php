@extends('layouts.app')

@section("content")
    <h1>Add post</h1>
    <br>

    <form action="/posts/{{$post->id}}" method="post">
        @csrf
        {{method_field("put")}}
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value={{$post->title}}><br><br>
        <label for="content">Content:</label>
        <input type="text" id="content" name="content" value={{$post->content}}><br><br>
        <input type="submit" value="Submit">
    </form>

    <br>
    <br>

    <form action="/posts/{{$post->id}}" method="post">
        @csrf
        {{method_field("DELETE")}}

        <input type="submit" value="Delete post">
    </form>
@stop
