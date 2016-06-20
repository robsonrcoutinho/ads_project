<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Disciplina;
use adsproject\User;

class DisciplinaPolicy
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
    public function salvar(User $user, Disciplina $disciplina)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Disciplina $disciplina)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Disciplina $disciplina)
    {
        return $user->role == 'admin';
    }
}
