<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

use App\Role;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // get role of the user
    public function role() {
      return $this->belongsTo('App\Role');
    }

    // check: the user has a specific role
    public function hasRole($roleName) {
      $role = Role::where('name','=',$roleName)->first();
      return (strtoupper($this->role->id) >= strtoupper($role->id));
    }

    // get all comments of the user
    public function comments() {
      return $this->hasMany('App\Comment');
    }

    // get all posts of the user
    public function posts() {
      return $this->hasMany('App\Post');
    }

    // check: the user is the owner of the specific post
    public function isPostOwner($id) {
      $post = Post::where('id','=',$id)->first();
      return ($this->id == $post->user->id);
    }
}
