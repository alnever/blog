<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PageController extends Controller
{

    /**
     * getHome - return main page view
     *
     * @return {View}
     */
    public function getHome() {
      $posts = Post::orderBy('id','desc')->paginate(10);
      return view("pages.home")->withPosts($posts);
    }


    /**
     * getAbout - return About page
     *
     * @return {View}
     */
    public function getAbout() {
      return view("pages.about");
    }


    /**
     * getContact - return Contact page
     *
     * @return {View}
     */
    public function getContact() {
      return view("pages.contact");
    }


    /**
     * getPost - show a single post in FEUI
     *
     * @param  {string} $slug post slug
     * @return {View}
     */
    public function getPost($slug) {
      // find a post
      $post = Post::where('slug', '=', $slug)->first();

      // return a view for the post
      return view("pages.post")->withPost($post);
    }
}
