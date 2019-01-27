<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Session;
use Mail;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request,[
          'message_id' => ['required'],
          'content' => ['required','min:1'],
        ]);

        // create a new answer
        $answer = new Answer($request->all());
        $answer->save();

        // send the answer via email
        // ... get the message
        $message = $answer->message;
        $data = [
          'email'    => $message->email,
          'topic'    => 'RE: '.$message->topic,
          'answerContent'  => $answer->content,
          'messageContent' => $message->content,
          'messageDate' => $message->created_at,
          'messageTopic'    => $message->topic,
        ];

        // ... send the answer
        Mail::send('emails.answer',$data, function($message) use ($data){
          $message->from('hello@alexblog.com');
          $message->to($data['email']);
          $message->subject($data['topic']);
        });


        // flash message
        Session::flash('success', 'The answer was successfully sent.');

        // redirect to the original message
        return redirect()->route('messages.show', $answer->message_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find an answer
        $answer = Answer::find($id);
        // get the message of the answer
        $message = $answer->message;
        // delete answer
        $answer->delete();
        Session::flash('success','The answer was successfully deleted.');

        // redirect to the original message
        return redirect()->route('messages.show',$message->id);
    }
}
