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
     * @param  {int} $id post id
     * @return {View}
     */
    public function getPost($id) {
      // find a post
      $post = Post::find($id);

      // return a view for the post
      return view("pages.post")->withPost($post);
    }
}
