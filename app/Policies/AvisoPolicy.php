<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Aviso;
use adsproject\User;

class AvisoPolicy
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
    public function salvar(User $user, Aviso $aviso)
    {
        return $user->role == 'admin' || $user->role == 'professor';
    }

    public function alterar(User $user, Aviso $aviso)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Aviso $aviso)
    {
        return $user->role == 'admin';
    }
}
