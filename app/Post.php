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

   public function category() {
     return $this->belongsTo('App\Category');
   }
}
