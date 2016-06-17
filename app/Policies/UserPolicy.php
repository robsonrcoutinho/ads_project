<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\User;

class UserPolicy
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

    public function salvar(User $altenticado, User $novo)
    {
        return $altenticado->role == 'admin';
    }

    public function alterar(User $altenticado, User $alterado)
    {
        return $altenticado->role == 'admin';
    }

    public function excluir(User $altenticado, User $excluido)
    {
        return $altenticado->role == 'admin';
    }
}
