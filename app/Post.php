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
}
