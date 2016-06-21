<?php

namespace adsproject\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'adsproject\Model' => 'adsproject\Policies\ModelPolicy',
        'adsproject\User' => 'adsproject\Policies\UserPolicy',
        'adsproject\Professor' => 'adsproject\Policies\ProfessorPolicy',
        'adsproject\Aluno' => 'adsproject\Policies\AlunoPolicy',
        'adsproject\Avaliacao' => 'adsproject\Policies\AvaliacaoPolicy',
        'adsproject\Aviso' => 'adsproject\Policies\AvisoPolicy',
        'adsproject\Disciplina' => 'adsproject\Policies\DisciplinaPolicy',
        'adsproject\Documento' => 'adsproject\Policies\DocumentoPolicy',
        'adsproject\Pergunta' => 'adsproject\Policies\PerguntaPolicy',
        'adsproject\Semestre' => 'adsproject\Policies\SemestrePolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}
