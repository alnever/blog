<?php

namespace App\Http\Middleware;

use Closure;

class CheckPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request->is('posts')
            || $request->is('posts/create')    // create a post
            || $request->is('posts/store')   // save the created post
            || ( $request->isMethod('GET') && preg_match('/posts\/\d+$/', $request->url()) )  // view the post
          ) {
            return $next($request);
        } else if ( ($request->isMethod('DELETE') && $request->is('posts/*'))  // delete the post
                    || preg_match('/posts\/\d+\/edit/', $request->url()) // edit the post
                    || ( ( $request->isMethod('PUT') || $request->isMethod('PATCH')) && preg_match('/posts\/\d+$/', $request->url()) )  // save the updated post
                  ) {
          if ( $request->user()->hasRole('Administrator') || $request->user()->isPostOwner($request->route()->parameters('post')) ) {
              return $next($request);
          }
        }
        return redirect()->route('posts.index');
    }
}
