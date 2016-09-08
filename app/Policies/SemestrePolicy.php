<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Semestre;
use adsproject\User;

class SemestrePolicy
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

    public function salvar(User $user, Semestre $semestre)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Semestre $semestre)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Semestre $semestre)
    {
        return $user->role == 'admin';
    }
    public function acao(User $user, Semestre $semestre)
    {
        return $this->alterar($user, $semestre) || $this->excluir($user, $semestre);
    }
}
