<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['email', 'topic', 'content', 'read'];

    public function answers() {
      return $this->hasMany('App\Answer');
    }
}
