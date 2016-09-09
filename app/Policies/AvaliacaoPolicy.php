<?php

namespace adsproject\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use adsproject\Avaliacao;
use adsproject\User;
use adsproject\Professor;

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

    public function relatorio(User $user, Avaliacao $avaliacao)
    {
        if ($user->role == 'professor'):                                        //Verifica se usu�rio � professor
            //Busca professor por nome e email
            $professor = Professor::buscarPorNomeEEmail($user->name, $user->email)->first();
            foreach ($professor->disciplinas as $disciplina):                   //Itera pelas disciplinas do professor
                if ($avaliacao->semestre->disciplinas->contains($disciplina)):  //Verifica se a disciplina est� no semestre da avalia��o
                    return true;                                                //Retorna verdadeiro se encontra alguma disciplina
                endif;
            endforeach;
        endif;
        return $user->role == 'admin';                                          //Retorna verdadeiro se usu�rio for admin
    }

    public function acao(User $user, Avaliacao $avaliacao)
    {
        return $user->role == 'admin' || $user->role == 'professor';
    }
}