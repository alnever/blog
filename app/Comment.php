<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  protected $fillable = [
    'content',
    'post_id',
    'user_id',
    'comment_id',
    'level',
    'created_at',
    'updated_at',
  ];

  public function post() {
    return $this->belongsTo('App\Post');
  }

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function comments() {
    return $this->hasMany('App\Comment');
  }

}
