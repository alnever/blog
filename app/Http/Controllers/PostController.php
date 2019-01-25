<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;

use App\Category;
use App\Tag;

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
      $categories = Category::all();
      $tags = Tag::all();
      return view('posts.create')
        ->withCategories($categories)
        ->withTags($tags);
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
          'slug' => ['required','min:5','max:255','alpha_dash','unique:posts,slug',],
        ]);

        // store in the database
        $post = new Post($request->all());
        $post->save();

        // add Tags
        // false - not rewrite existing associations
        $post->tags()->sync($request->input('tags'), false);

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
      // get the post
      $post = Post::find($id);
      // return a view
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
        // get categories and convert them into an array for select element
        $categories = [];
        foreach (Category::all() as $category) {
          $categories[$category->id] = $category->name;
        }
        // get tags
        $tags = [];
        foreach (Tag::all() as $tag) {
          $tags[$tag->id] = $tag->name;
        }
        // return a view with an edit form
        return view('posts.edit')
          ->withPost($post)
          ->withCategories($categories)
          ->withTags($tags);
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
      // find a post
      $post = Post::find($id);

      // validate the data
      if ($request->input('slug') == $post->slug) {
        $this->validate($request,[
          'title' => ['required', 'min:1', 'max:255'],
          'content' => ['required'],
        ]);
      } else {
        $this->validate($request,[
          'title' => ['required', 'min:1', 'max:255'],
          'content' => ['required'],
          'slug' => ['required','min:5','max:255','alpha_dash','unique:posts,slug',],
        ]);
      }

      // update data
      $post->update($request->all());

      // save data
      $post->save();

      // save Tags
      // recreating associations
      $post->tags()->sync($request->input('tags'), true);

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
