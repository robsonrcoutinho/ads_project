<?php
namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Professor;
use adsproject\User;

class ProfessorPolicy
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

    public function salvar(User $user, Professor $professor)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Professor $professor)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Professor $professor)
    {
        return $user->role == 'admin';
    }

    public function acao(User $user, Professor $professor)
    {
        return $this->alterar($user, $professor) || $this->excluir($user, $professor);
    }
}
