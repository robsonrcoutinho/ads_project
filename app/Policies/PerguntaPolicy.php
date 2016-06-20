<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Pergunta;
use adsproject\User;

class PerguntaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function salvar(User $user, Pergunta $pergunta)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Pergunta $pergunta)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Pergunta $pergunta)
    {
        return $user->role == 'admin';
    }
}
