<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Aluno;
use adsproject\User;

class AlunoPolicy
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
    public function salvar(User $user, Aluno $aluno)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Aluno $aluno)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Aluno $aluno)
    {
        return $user->role == 'admin';
    }
}
