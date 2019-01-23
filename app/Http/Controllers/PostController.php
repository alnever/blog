<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view("posts.index")->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request,[
          'title' => ['required', 'min:1', 'max:255'],
          'content' => ['required'],
        ]);

        // store in the database
        $post = new Post($request->all());

        // $post->title = $request->title;
        // $post->content = $request->content;

        $post->save();

        // flash message
        Session::flash('success','The new post is successfully created!');

        // redirect to another page
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->withPost($post);
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
      // validate the data
      $this->validate($request,[
        'title' => ['required', 'min:1', 'max:255'],
        'content' => ['required'],
      ]);

      // find a post
      $post = Post::find($id);

      // update data
      $post->update($request->all());

      // save data
      $post->save();

      //send flash message
      Session::flash('success','The post was updated successfully.');

      return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find a post
        $post = Post::find($id);
        // delete post
        $post->delete();
        // flash message
        Session::flash('success','The post was deleted successfully.');
        // redirect
        return redirect()->route('posts.index');
    }
}
