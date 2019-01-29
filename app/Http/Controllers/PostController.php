<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Purifier;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Auth;

use App\Post;
use App\Category;
use App\Tag;
use App\Comment;

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
          'featured_image' => ['image'],
        ]);

        // store in the database
        $post = new Post($request->all());

        // sanitize content
        $post->content = Purifier::clean($request->input('content'));

        // save image
        if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . "." . $image->getClientOriginalExtension();
          $location = public_path("images/" . $filename);

          Image::make($image)->resize(1024, null, function($constraint) {
            $constraint->aspectRatio();
          })->save($location);

          $post->featured_image = $filename;
        }

        // set user_id
        $post->user_id = Auth::user()->id;

        // save the post
        $post->save();

        // add categories
        $post->categories()->sync($request->input('categories'), false);

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
      // get comments
      $comments = Comment::where('post_id','=',$post->id)
        ->orderBy('created_at','desc')
        ->paginate(10);
      // return a view
      return view('posts.show')->withPost($post)->withComments($comments);
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
          'featured_image' => ['image'],
        ]);
      } else {
        $this->validate($request,[
          'title' => ['required', 'min:1', 'max:255'],
          'content' => ['required'],
          'slug' => ['required','min:5','max:255','alpha_dash','unique:posts,slug',],
          'featured_image' => ['mimes:jpeg,png'],
        ]);
      }

      // update data
      $post->update($request->all());

      // sanitize content
      $post->content = Purifier::clean($request->input('content'));

      // save image
      if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');

        // replace file if exists
        if ($post->featured_image && $post->featured_image != '') {
          $filename = $post->featured_image;
        } else {
          $filename = time() . "." . $image->getClientOriginalExtension();
        }

        //
        $location = public_path("images/" . $filename);

        Image::make($image)->resize(1024, null, function($constraint) {
          $constraint->aspectRatio();
        })->save($location);

        // save to the database
        $post->featured_image = $filename;
      }

      // save data
      $post->save();

      // save Tags
      // recreating associations
      $post->tags()->sync($request->input('tags'), true);

      // add categories
      $post->categories()->sync($request->input('categories'), true);

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
        // delete post image
        File::delete(public_path("images/" . $post->featured_image));
        // delete post
        $post->delete();
        // flash message
        Session::flash('success','The post was deleted successfully.');
        // redirect
        return redirect()->route('posts.index');
    }

}
