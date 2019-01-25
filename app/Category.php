<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //
    protected $fillable = ['name', 'slug', 'created_at', 'updated_at'];


    /**
     * posts - return posts for the category
     *
     * @return App\Post
     */
    public function posts() {
      return $this->belongsToMany('App\Post','post_category','category_id','post_id');
    }

}
