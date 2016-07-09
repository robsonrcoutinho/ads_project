<?php

namespace adsproject\Http\Middleware;

use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
      /*  $user = $request->user();
        if ($user == null):
            return redirect('auth/login');
        endif;
        foreach ($roles as $role):
            if ($role == $user->role):
                return $next($request);
            endif;
        endforeach;*/
        return redirect('/');
    }
}
