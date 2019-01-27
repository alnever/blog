<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

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
     * postContact - post a message to the email
     *
     * @param Request $request - contact form content
     *
     * @return
     */
    public function postContact(Request $request) {
      // validate form fields
      $this->validate($request, [
        'email' => ['required', 'email'],
        'topic' => ['required', 'min:1'],
        'message' => ['required', 'min:1'],
      ]);

      // create array of data to send
      $data = [
        'email'   => $request->input('email'),
        'topic'   => $request->input('topic'),
        'content' => $request->input('message'),
      ];

      // send a mail
      Mail::send('emails.contact', $data, function($message) use ($data){
        $message->from($data['email']);
        $message->to('hello@alexblog.com');
        $message->subject($data['topic']);
      });

      // flash message
      Session::flash('success', 'Your message is sent successfully. We will contact with you asap!');

      return view('pages.contact');
    }

}
