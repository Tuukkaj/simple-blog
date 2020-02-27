<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Post list view
     */
    public function index()
    {
        $posts = Post::all();

        return view("post_list", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Add post view or login depending on if user has logged in
     */
    public function create(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view("add_post");
        } else {
            return redirect("/posts");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            $array =  $request->all();
            $array["user_id"] = Auth::user()->id;

            $post = new Post($array);
            $post->save();

            return redirect("/posts/$post->id");
        } else {
            return response("Admin permissions required", 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View with Post information
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            "post" => $post,
            "user" => $post->user->name,
            "comments" => $post->comments
        ];

        return view("post_view")->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->isAdmin()) {
            $post = Post::findOrFail($id);

            $data = [
                "post" => $post,
            ];

            return view("post_edit")->with($data);
        } else {
            return response("Admin permissions required", 401);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->isAdmin()) {
            $post = Post::findOrFail($id);

            $post->title = $request->input("title");
            $post->content = $request->input("content");
            $post->user_id = Auth::user()->id;

            $post->save();

            return response("Post has been updated", 200);
        } else {
            return response("Admin permissions required", 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->isAdmin()) {
            $post = Post::findOrFail($id);

            $post->delete();

            return response("Post has been deleted", 200);
        } else {
            return response("Admin permissions required", 401);
        }
    }
}
