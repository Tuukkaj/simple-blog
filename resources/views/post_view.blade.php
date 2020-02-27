@extends("layouts.app")

@section("content")
    <h1>{{$post->title}}</h1>
    <h3>{{$user}}</h3>
    <br>
    <p>{{$post->content}}</p>

    <br>
    <br>
    <h4>Comments</h4>
    <ul>
        @foreach($comments as $comment)
            <li>
                <b>{{$comment->user->name}}</b>:
                {{$comment->comment}}
            </li>
            <br>
        @endforeach
    </ul>
    <br>
    Add comment
    <br>

    <form action="/posts/{{$post->id}}/comment" method="post">
        @csrf
        <textarea name="comment"></textarea>
        <br><br>
        <input type="submit" value="Add comment">
    </form>
@stop
