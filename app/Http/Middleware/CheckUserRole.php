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
        $user = $request->user();               //Pega usu�rio do request
        if ($user == null):                     //Verifica se usu�rio � nulo
            return redirect('auth/login');      //Redireciona para p�gina de login
        endif;
        foreach ($roles as $role):              //Intera pelos papeis passados
            if ($user->role == $role):          //Verifica se o usu�rio tem um dos papeis passados
                return $next($request);         //Envia usu�rio para pr�xima p�gina
            endif;
        endforeach;
        return redirect('/');                   //Redireciona usu�rio para p�gina inicial
    }
}
