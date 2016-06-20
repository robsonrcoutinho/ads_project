<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Documento;
use adsproject\User;

class DocumentoPolicy
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
    public function salvar(User $user, Documento $documento)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user, Documento $documento)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user, Documento $documento)
    {
        return $user->role == 'admin';
    }
}
