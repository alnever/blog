<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['message_id', 'content'];

    public function message() {
      return $this->belongsTo('App\Message');
    }

}
