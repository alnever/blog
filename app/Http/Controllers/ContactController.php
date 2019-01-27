<?php

namespace App\Http\Controllers;
use Mail;
use Session;

use Illuminate\Http\Request;

use App\Message;

class ContactController extends Controller
{
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
      'email' => ['required', 'email', 'max:255'],
      'topic' => ['required', 'min:1', 'max:255'],
      'content' => ['required', 'min:1'],
    ]);

    // create array of data to send
    $data = [
      'email'   => $request->input('email'),
      'topic'   => $request->input('topic'),
      'content' => $request->input('content'),
    ];

    // send a mail
    Mail::send('emails.contact', $data, function($message) use ($data){
      $message->from($data['email']);
      $message->to('hello@alexblog.com');
      $message->subject($data['topic']);
    });

    // Save message to the database
    $message = new Message($request->all());
    $message->save();

    // flash message
    Session::flash('success', 'Your message is sent successfully. We will contact with you asap!');

    return view('pages.contact');
  }
}
