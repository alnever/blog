<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //
    protected $fillable = ['name', 'slug', 'created_at', 'updated_at'];

    public function posts() {
      return $this->hasMany('App\Post');
    }

    public function delete() {
      // delete from child tables
      DB::table("posts")
        ->where("category_id","=",$this->id)
        ->update(["category_id" => null]);
      // delete current record
      parent::delete();
    }
}
