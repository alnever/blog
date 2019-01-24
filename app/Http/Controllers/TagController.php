<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('tags.index')->withTags($tags);
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
        // validate
        $this->validate($request,[
          'name' => ['required', 'min:1', 'max:255','unique:tags,name'],
        ]);
        // create new tag
        $tag = new Tag($request->all());
        // save to the database
        $tag->save();
        // flash message
        Session::flash('success', 'The tag is successfully created.');
        // update view
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id tag's id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find a tag
        $tag = Tag::find($id);
        // return a view
        return view('tags.edit')->withTag($tag);
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
        // find a tag
        $tag = Tag::find($id);
        // validate
        if ($request->input('name') != $tag->name) {
          $this->validate($request,[
            'name' => ['required', 'min:1', 'max:255','unique:tags,name'],
          ]);
        }
        // update
        $tag->update($request->all());
        // save
        $tag->save();
        // flash message
        // flash message
        Session::flash('success', 'The tag is successfully updated.');
        // update view
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
      // find a tag
      $tag = Tag::find($id);
      // delete
      $tag->delete();
      // flash message
      Session::flash('success', 'The tag is successfully deleted.');
      // update view
      return redirect()->back();
    }
}
