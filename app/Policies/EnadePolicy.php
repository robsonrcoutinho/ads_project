<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Enade;
use adsproject\User;

class EnadePolicy
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

    public function salvar(User $user, Enade $enade)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Enade $enade)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Enade $enade)
    {
        return $user->role == 'admin';
    }
}
