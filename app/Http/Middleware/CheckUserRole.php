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
        $user = $request->user();               //Pega usuário do request
        if ($user == null):                     //Verifica se usuário é nulo
            return redirect('auth/login');      //Redireciona para página de login
        endif;
        foreach ($roles as $role):              //Intera pelos papeis passados
            if ($user->role == $role):          //Verifica se o usuário tem um dos papeis passados
                return $next($request);         //Envia usuário para próxima página
            endif;
        endforeach;
        return redirect('/');                   //Redireciona usuário para página inicial
    }
}
