<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        $this->validate($request, [
          'name' => ['required', 'min:1', 'max:255','unique:categories,name'],
          'slug' => ['required', 'min:1', 'max:255','alpha_dash','unique:categories,slug'],
        ]);
        // create new category
        $category = new Category($request->all());
        // save
        $category->save();
        // flash message
        Session::flash('success','The category was successfully created.');
        // redirect to the categories list
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id category id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id category id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id - category id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // find a category
      $category = Category::find($id);
      // validate
        if ($request->input('name') != $category->name && $request->input('slug') != $category->slug) {
          $this->validate($request, [
            'name' => ['required', 'min:1', 'max:255','unique:categories,name'],
            'slug' => ['required', 'min:1', 'max:255','alpha_dash','unique:categories,slug'],
          ]);
        } else if ($request->input('name') != $category->name && $request->input('slug') == $category->slug) {
          $this->validate($request, [
            'name' => ['required', 'min:1', 'max:255','unique:categories,name'],
          ]);
        } else if ($request->input('name') == $category->name && $request->input('slug') != $category->slug) {
          $this->validate($request, [
            'slug' => ['required', 'min:1', 'max:255','alpha_dash','unique:categories,slug'],
          ]);
        }
        // update category
        $category->update($request->all());
        // save
        $category->save();
        // flash message
        Session::flash('success','The category was successfully updated.');
        // redirect to the categories list
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id - id category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find Category
        $category = Category::find($id);
        // delete the category
        $category->delete();
        // flash message
        Session::flash('success','The category was successfully deleted.');
        // redirect
        return redirect()->route('categories.index');
    }
}
