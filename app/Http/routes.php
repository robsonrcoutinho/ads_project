<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('main');
});


//Rotas de Alunos
Route::group(['prefix' => 'alunos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAluno
    Route::get('', ['as' => 'alunos', 'uses' => 'AlunosController@index']);
//Rota para novo aluno
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.novo', 'uses' => 'AlunosController@novo']);
//Rota para salvar aluno
    Route::post('salvar', ['as' => 'alunos.salvar', 'uses' => 'AlunosController@salvar']);
//Rota para excluir aluno
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.excluir', 'uses' => 'AlunosController@excluir']);
//Rota para editar aluno
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.editar', 'uses' => 'AlunosController@editar']);
//Rota para alterar aluno
    Route::put('{id}/alterar', ['as' => 'alunos.alterar', 'uses' => 'AlunosController@alterar']);
});

//Rotas de professores
Route::group(['prefix' => 'professores', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexProfessor
    Route::get('', ['as' => 'professores', 'uses' => 'ProfessoresController@index']);
    //Route::get('professores', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
//Rota para novo professor
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'professores.novo', 'uses' => 'ProfessoresController@novo']);
//Rota para salvar professor
    Route::post('salvar', ['as' => 'professores.salvar', 'uses' => 'ProfessoresController@salvar']);
//Rota para exluir professor
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'professores.excluir', 'uses' => 'ProfessoresController@excluir']);
//Rota para ediçaoo de professor
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'professores.editar', 'uses' => 'ProfessoresController@editar']);
//Rota para alteraçao de professor
    Route::put('{id}/alterar', ['as' => 'professores.alterar', 'uses' => 'ProfessoresController@alterar']);
});
//Rotas de disciplinas
Route::group(['prefix' => 'disciplinas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexDisciplina
    Route::get('', ['as' => 'disciplinas', 'uses' => 'DisciplinasController@index']);
//Rota para nova disciplina
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.novo', 'uses' => 'DisciplinasController@novo']);
//Rota para salvar disciplina
    Route::post('salvar', ['as' => 'disciplinas.salvar', 'uses' => 'DisciplinasController@salvar']);
//Rota para exluir disciplina
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.excluir', 'uses' => 'DisciplinasController@excluir']);
//Rota para editar disciplina
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.editar', 'uses' => 'DisciplinasController@editar']);
//Rota para alterar disciplina
    Route::put('{id}/alterar', ['as' => 'disciplinas.alterar', 'uses' => 'DisciplinasController@alterar']);
});
//Rotas de documentos
Route::group(['prefix' => 'documentos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexDocumentos
    Route::get('', ['as' => 'documentos', 'uses' => 'DocumentosController@index']);
//Rota para novo documento
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.novo', 'uses' => 'DocumentosController@novo']);
//Rota para salvar documento
    Route::post('salvar', ['as' => 'documentos.salvar', 'uses' => 'DocumentosController@salvar']);
//Rota para exluir documento
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.excluir', 'uses' => 'DocumentosController@excluir']);
//Rota para editar documento
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.editar', 'uses' => 'DocumentosController@editar']);
//Rota para alterar documento
    Route::put('{id}/alterar', ['as' => 'documentos.alterar', 'uses' => 'DocumentosController@alterar']);
});

//Rotas de semestres
Route::group(['prefix' => 'semestres', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexSemestre
    Route::get('', ['as' => 'semestres', 'uses' => 'SemestresController@index']);
//Rota para novo semestre
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.novo', 'uses' => 'SemestresController@novo']);
//Rota para salvar semestre
    Route::post('salvar', ['as' => 'semestres.salvar', 'uses' => 'SemestresController@salvar']);
//Rota para exluir semestre
    //Route::get('{codigo}/excluir',['middleware'=>'check.user.role:admin','as'=>'Semestres.excluir', 'uses'=> 'SemestresController@excluir']);
//Rota para editar semestre
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.editar', 'uses' => 'SemestresController@editar']);
//Rota para alterar semestre
    Route::put('{id}/alterar', ['as' => 'semestres.alterar', 'uses' => 'SemestresController@alterar']);
});
//Rotas de avaliações
Route::group(['prefix' => 'avaliacoes', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAvaliacao
    Route::get('', ['as' => 'avaliacoes', 'uses' => 'AvaliacoesController@index']);
//Rota para nova avaliacao
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.novo', 'uses' => 'AvaliacoesController@novo']);
//Rota para salvar avaliacao
    Route::post('salvar', ['as' => 'avaliacoes.salvar', 'uses' => 'AvaliacoesController@salvar']);
//Rota para exluir avaliacao
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.excluir', 'uses' => 'AvaliacoesController@excluir']);
//Rota para editar avaliacao
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.editar', 'uses' => 'AvaliacoesController@editar']);
//Rota para alterar avaliacao
    Route::put('{id}/alterar', ['as' => 'avaliacoes.alterar', 'uses' => 'AvaliacoesController@alterar']);
});
//Rotas de avisos
Route::group(['prefix' => 'avisos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAviso
    Route::get('', ['as' => 'avisos', 'uses' => 'AvisosController@index']);
//Rota para nova aviso
    Route::get('novo', ['middleware' => 'check.user.role:admin,professor', 'as' => 'avisos.novo', 'uses' => 'AvisosController@novo']);
//Rota para salvar aviso
    Route::post('salvar', ['as' => 'avisos.salvar', 'uses' => 'AvisosController@salvar']);
//Rota para exluir aviso
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'avisos.excluir', 'uses' => 'AvisosController@excluir']);
//Rota para editar aviso
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'avisos.editar', 'uses' => 'AvisosController@editar']);
//Rota para alterar aviso
    Route::put('{id}/alterar', ['as' => 'avisos.alterar', 'uses' => 'AvisosController@alterar']);
});

//Rotas de perguntas
Route::group(['prefix' => 'perguntas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexPergunta
    Route::get('', ['as' => 'perguntas', 'uses' => 'PerguntasController@index']);
//Rota para nova pergunta
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.novo', 'uses' => 'PerguntasController@novo']);
//Rota para salvar pergunta
    Route::post('salvar', ['as' => 'perguntas.salvar', 'uses' => 'PerguntasController@salvar']);
//Rota para exluir pergunta
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.excluir', 'uses' => 'PerguntasController@excluir']);
//Rota para editar pergunta
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.editar', 'uses' => 'PerguntasController@editar']);
//Rota para alterar pergunta
    Route::put('{id}/alterar', ['as' => 'perguntas.alterar', 'uses' => 'PerguntasController@alterar']);
});
//Rotas de respostas
Route::group(['prefix' => 'respostas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexResposta
    Route::get('', ['middleware'=>'check.user.role:admin','as' => 'respostas', 'uses' => 'RespostasController@index']);
});
//Rotas de users
Route::group(['prefix' => 'users', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexUser
    Route::get('', ['as' => 'users', 'uses' => 'UsersController@index']);
//Rota para novo user
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'users.novo', 'uses' => 'UsersController@novo']);
//Rota para salvar user
    Route::post('salvar', ['as' => 'users.salvar', 'uses' => 'UsersController@salvar']);
//Rota para exluir user
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'users.excluir', 'uses' => 'UsersController@excluir']);
//Rota para editar user
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'users.editar', 'uses' => 'UsersController@editar']);
//Rota para alterar user
    Route::put('{id}/alterar', ['as' => 'users.alterar', 'uses' => 'UsersController@alterar']);
});


//Rotas para Web Service
Route::group(['prefix' => 'ws'], function () {
    //Rotas WS Professores
    Route::group(['prefix' => 'professores'], function () {
        //Lista todos os professores
        Route::get('', ['uses' => 'ProfessoresController@buscarTodos']);
        //Busca professor por id
        Route::get('{id}', ['uses' => 'ProfessoresController@buscarPorId']);
        //
        /*Route::post('',[ 'uses'=>'ProfessoresController@criar']);
        //
        Route::put('{id}',['as'=>'professores', 'uses'=>'ProfessoresController@modificar']);
        //
        Route::delete('{id}',['as'=>'professores', 'uses'=>'ProfessoresController@remover']);*/
    });
    //Rotas WS Disciplinas
    Route::group(['prefix' => 'disciplinas'], function () {
        //Lista todos as disciplinas
        Route::get('', ['uses' => 'DisciplinasController@buscarTodos']);
        //Busca disciplina por id
        Route::get('{id}', ['uses' => 'DisciplinasController@buscarPorId']);
    });
    //Rotas WS Documentos
    Route::group(['prefix' => 'documentos'], function () {
        //Lista todos os documentos
        Route::get('', ['uses' => 'DocumentosController@buscarTodos']);
        //Busca documento por id
        Route::get('{id}', ['uses' => 'DocumentosController@buscarPorId']);
        //Busca por título do documento
        Route::get('titulo/{titulo}', ['uses' => 'DocumentosController@buscarPorTitulo']);
    });
    //Rotas WS Semestres
    Route::group(['prefix' => 'semestres'], function () {
        //Lista todos os semestres
        Route::get('', ['uses' => 'SemestresController@buscarTodos']);
        //Busca semestre por id
        Route::get('{id}', ['uses' => 'SemestresController@buscarPorId']);
    });
    //Rotas WS Avaliações
    Route::group(['prefix' => 'avaliacoes'], function () {
        //Lista todos os documentos
        Route::get('', ['uses' => 'AvaliacoesController@buscarTodos']);
        //Busca disciplina por id
        Route::get('{id}', ['uses' => 'AvaliacoesController@buscarPorId']);
    });
    //Rotas WS Avisos
    Route::group(['prefix' => 'avisos'], function () {
        //Lista todos os avisos
        Route::get('', ['uses' => 'AvisosController@buscarTodos']);
        //Busca aviso por id
        Route::get('{id}', ['uses' => 'AvisosController@buscarPorId']);
    });
    //Rotas WS Perguntas
    Route::group(['prefix' => 'perguntas'], function () {
        //Lista todos os avisos
        Route::get('', ['uses' => 'PerguntasController@buscarTodos']);
        //Busca aviso por id
        Route::get('{id}', ['uses' => 'PerguntasController@buscarPorId']);
    });
    //Rotas WS Questionários
    Route::group(['prefix' => 'questionarios'], function () {
        //Busca avaliação em aberto
        Route::get('', ['uses' => 'QuestionariosController@buscarAberto']);
        //Salva respostas de avaliação
        Route::post('', ['uses' => 'QuestionariosController@salvarRespostas']);
    });
});

//Testando push notification
Route::get('push', ['uses' => 'PushNotificationController@sendNotificationToDevice']);

// TokenController / TokenController
Route::post('token', ['as' => 'token', 'uses' => 'TokenController@salvarToken']);

//Rotas do questionário de avaliação
Route::group(['prefix' => 'questionarios'], function () {
    //Rota para resposta de questionário (inicial)
    Route::get('', ['as' => 'questionarios', 'uses' => 'QuestionariosController@novo']);
    //Rota para salvar o questionário (depois de respondido)
    Route::post('salvar', ['as' => 'questionarios.salvar', 'uses' => 'QuestionariosController@salvar']);
});

//Rotas de autenticação
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Rotas de registro
Route::get('auth/register', ['as' => 'registro', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'registrar', 'uses' => 'Auth\AuthController@postRegister']);

//Rotas para solicitar troca de senha
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
//Rotas para trocar senha
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', 'Auth\PasswordController@postReset');


/*
// Verifica se o usuário está logado
Route::group(array('before' => 'auth'), function()
{
    // Rota de artigos
    Route::controller('artigos', 'ArtigosController');

    // Rotas do administrador
    Route::group(array('before' => 'auth.admin'), function()
    {
        Route::controller('usuarios', 'UsuariosController');
    });
});*/