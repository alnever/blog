<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;


class BlogController extends Controller
{

    /**
     * getPost - show a single post in FEUI
     *
     * @param  {string} $slug post slug
     * @return Response
     */
    public function getPost($slug) {
      // find a post
      $post = Post::where('slug', '=', $slug)->first();

      // return a view for the post
      return view("blog.post")->withPost($post);
    }


    /**
     * getCategory - description
     *
     * @param  string $slug - category's slug
     * @return Response
     *
     */
    public function getCategory($slug) {
      $category = Category::where('slug','=',$slug)->first();

      $posts = $category->posts()->paginate(10);

      return view("blog.category")
        ->withCategory($category)
        ->withPosts($posts);
    }

    public function getTag($slug) {
      $tag = Tag::where('name','=',$slug)->first();

      $posts = $tag->posts()->paginate(10);

      return view("blog.tag")
        ->withTag($tag)
        ->withPosts($posts);
    }

}
