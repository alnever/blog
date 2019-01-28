<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   //
   protected $fillable = [
      'id',
      'title',
      'content',
      'slug',
      'created_at',
      'updated_at',
   ];


   /**
    * category - return categories for the post
    *
    * @return App\Category
    */
   public function categories() {
     return $this->belongsToMany('App\Category','post_category','post_id','category_id');
   }


   /**
    * tags - return tags of current post
    *
    * @return App\Tag
    */
   public function tags() {
      return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
   }


   /**
    * comments - return comments for the post
    *
    * @return App\Comment
    */
   public function comments() {
     return $this->hasMany('App\Comment');
   }
}
