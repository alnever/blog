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
      'category_id',
      'created_at',
      'updated_at',
   ];


   /**
    * category - return category of this post
    *
    * @return App\Category
    */
   public function category() {
     return $this->belongsTo('App\Category');
   }


   /**
    * tags - return tags of current post
    *
    * @return App\Tag    
    */
   public function tags() {
      return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
   }
}
