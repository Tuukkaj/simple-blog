@extends('layouts.app')

@section("content")
    <h1>Add post</h1>
    <br>

    <form action="/posts" method="post">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title"><br><br>
        <label for="content">Content:</label>
        <input type="text" id="content" name="content"><br><br>
        <input type="submit" value="Submit">
    </form>
@stop
