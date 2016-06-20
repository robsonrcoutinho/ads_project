<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Avaliacao;
use adsproject\User;

class AvaliacaoPolicy
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
    public function salvar(User $user, Avaliacao $avaliacao)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Avaliacao $avaliacao)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Avaliacao $avaliacao)
    {
        return $user->role == 'admin';
    }
}
