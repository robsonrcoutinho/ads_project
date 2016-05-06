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

Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

//Rotas de login
Route::get('login', ['as' =>'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

//Rotas de Registro..
Route::get('register', ['as' =>'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' =>'register', 'uses' => 'Auth\AuthController@postRegister']);


//Rotas de professores
Route::group(['prefix'=>'professores', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexProfessor
    Route::get('', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
   //Route::get('professores', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
//Rota para novo professor
    Route::get('novo',['as'=>'professores.novo', 'uses'=> 'ProfessoresController@novo']);
//Rota para salvar professor
    Route::post('salvar', ['as'=>'professores.salvar', 'uses'=>'ProfessoresController@salvar']);
//Rota para exluir professor
    Route::get('{id}/excluir',['as'=>'professores.excluir', 'uses'=> 'ProfessoresController@excluir']);
//Rota para ediçaoo de professor
    Route::get('{id}/editar',['as'=>'professores.editar', 'uses'=>'ProfessoresController@editar']);
//Rota para alteraçao de professor
    Route::put('{id}/alterar',['as'=>'professores.alterar', 'uses'=> 'ProfessoresController@alterar']);

});
//Rotas de disciplinas
Route::group(['prefix'=>'disciplinas', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexDisciplina
    Route::get('', ['as'=>'disciplinas', 'uses' =>'DisciplinasController@index']);
//Rota para nova disciplina
    Route::get('novo',['as'=>'disciplinas.novo', 'uses'=> 'DisciplinasController@novo']);
//Rota para salvar disciplina
    Route::post('salvar', ['as'=>'disciplinas.salvar', 'uses'=>'DisciplinasController@salvar']);
//Rota para exluir disciplina
    Route::get('{id}/excluir',['as'=>'disciplinas.excluir', 'uses'=> 'DisciplinasController@excluir']);
//Rota para editar disciplina
    Route::get('{id}/editar',['as'=>'disciplinas.editar', 'uses'=>'DisciplinasController@editar']);
//Rota para alterar disciplina
    Route::put('{id}/alterar',['as'=>'disciplinas.alterar', 'uses'=> 'DisciplinasController@alterar']);
});
//Rotas de documentos
Route::group(['prefix'=>'documentos', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexDocumentos
    Route::get('', ['as'=>'documentos', 'uses' =>'DocumentosController@index']);
//Rota para novo documento
    Route::get('novo',['as'=>'documentos.novo', 'uses'=> 'DocumentosController@novo']);
//Rota para salvar documento
    Route::post('salvar', ['as'=>'documentos.salvar', 'uses'=>'DocumentosController@salvar']);
//Rota para exluir documento
    Route::get('{id}/excluir',['as'=>'documentos.excluir', 'uses'=> 'DocumentosController@excluir']);

//Rota para editar documento
    Route::get('{id}/editar',['as'=>'documentos.editar', 'uses'=>'DocumentosController@editar']);
//Rota para alterar documento
    Route::put('{id}/alterar',['as'=>'documentos.alterar', 'uses'=> 'DocumentosController@alterar']);
});
//Rotas de semestres
Route::group(['prefix'=>'semestres','where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexSemestre
    Route::get('', ['as'=>'semestres', 'uses' =>'SemestresController@index']);
//Rota para novo semestre
    Route::get('novo',['as'=>'semestres.novo', 'uses'=> 'SemestresController@novo']);
//Rota para salvar semestre
    Route::post('salvar', ['as'=>'semestres.salvar', 'uses'=>'SemestresController@salvar']);
//Rota para exluir semestre
    //Route::get('{codigo}/excluir',['as'=>'Semestres.excluir', 'uses'=> 'SemestresController@excluir']);
//Rota para editar semestre
    Route::get('{id}/editar',['as'=>'semestres.editar', 'uses'=>'SemestresController@editar']);
//Rota para alterar semestre
    Route::put('{id}/alterar',['as'=>'semestres.alterar', 'uses'=> 'SemestresController@alterar']);
});
//Rotas de avaliações
Route::group(['prefix'=>'avaliacoes', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexAvaliacao
    Route::get('', ['as'=>'avaliacoes', 'uses' =>'AvaliacoesController@index']);
//Rota para nova avaliacao
    Route::get('novo',['as'=>'avaliacoes.novo', 'uses'=> 'AvaliacoesController@novo']);
//Rota para salvar avaliacao
    Route::post('salvar', ['as'=>'avaliacoes.salvar', 'uses'=>'AvaliacoesController@salvar']);
//Rota para exluir avaliacao
    Route::get('{id}/excluir',['as'=>'avaliacoes.excluir', 'uses'=> 'AvaliacoesController@excluir']);
//Rota para editar avaliacao
    Route::get('{id}/editar',['as'=>'avaliacoes.editar', 'uses'=>'AvaliacoesController@editar']);
//Rota para alterar avaliacao
    Route::put('{id}/alterar',['as'=>'avaliacoes.alterar', 'uses'=> 'AvaliacoesController@alterar']);
});
//Rotas de avisos
Route::group([ 'prefix'=>'avisos', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexAviso
    Route::get('', ['as'=>'avisos', 'uses' =>'AvisosController@index']);
//Rota para nova aviso
    Route::get('novo',['as'=>'avisos.novo', 'uses'=> 'AvisosController@novo']);
//Rota para salvar aviso
    Route::post('salvar', ['as'=>'avisos.salvar', 'uses'=>'AvisosController@salvar']);
//Rota para exluir aviso
    Route::get('{id}/excluir',['as'=>'avisos.excluir', 'uses'=> 'AvisosController@excluir']);
//Rota para editar aviso
    Route::get('{id}/editar',['as'=>'avisos.editar', 'uses'=>'AvisosController@editar']);
//Rota para alterar aviso
    Route::put('{id}/alterar',['as'=>'avisos.alterar', 'uses'=> 'AvisosController@alterar']);
});

//Rotas de perguntas
Route::group(['prefix'=>'perguntas', 'where'=>['id'=>'[0-9]+']], function(){
//Rota para IndexPergunta
    Route::get('', ['as'=>'perguntas', 'uses' =>'PerguntasController@index']);
//Rota para nova pergunta
    Route::get('novo',['as'=>'perguntas.novo', 'uses'=> 'PerguntasController@novo']);
//Rota para salvar pergunta
    Route::post('salvar', ['as'=>'perguntas.salvar', 'uses'=>'PerguntasController@salvar']);
//Rota para exluir pergunta
    Route::get('{id}/excluir',['as'=>'perguntas.excluir', 'uses'=> 'PerguntasController@excluir']);
//Rota para editar pergunta
    Route::get('{id}/editar',['as'=>'perguntas.editar', 'uses'=>'PerguntasController@editar']);
//Rota para alterar pergunta
    Route::put('{id}/alterar',['as'=>'perguntas.alterar', 'uses'=> 'PerguntasController@alterar']);
});


//Rotas para Web Service
Route::group(['prefix'=>'ws'], function(){
   //Rotas WS Professores
    Route::group(['prefix'=>'professores'], function(){
        //Lista todos os professores
        Route::get('',['as'=>'professores', 'uses'=>'ProfessoresController@buscarTodos']);
        //Busca professor por id
        Route::get('{id}',['as'=>'professores', 'uses'=>'ProfessoresController@buscarPorId']);
        //
        /*Route::post('',['as'=>'professores', 'uses'=>'ProfessoresController@criar']);
        //
        Route::put('{id}',['as'=>'professores', 'uses'=>'ProfessoresController@modificar']);
        //
        Route::delete('{id}',['as'=>'professores', 'uses'=>'ProfessoresController@remover']);*/
    });
    //Rotas WS Disciplinas
    Route::group(['prefix'=>'disciplinas'], function(){
        //Lista todos as disciplinas
        Route::get('',['as'=>'disciplinas', 'uses'=>'DisciplinasController@buscarTodos']);
        //Busca disciplina por id
        Route::get('{id}',['as'=>'disciplinas', 'uses'=>'DisciplinasController@buscarPorId']);
    });
    //Rotas WS Documentos
    Route::group(['prefix'=>'documentos'], function(){
        //Lista todos os documentos
        Route::get('',['as'=>'documentos', 'uses'=>'DocumentosController@buscarTodos']);
        //Busca documento por id
        Route::get('{id}',['as'=>'documentos', 'uses'=>'DocumentosController@buscarPorId']);
        //Busca por título do documento
        Route::get('titulo/{titulo}',['as'=>'documentos', 'uses'=>'DocumentosController@buscarPorTitulo']);

    });
    //Rotas WS Semestres
    Route::group(['prefix'=>'semestres'], function(){
        //Lista todos os semestres
        Route::get('',['as'=>'semestres', 'uses'=>'SemestresController@buscarTodos']);
        //Busca semestre por id
        Route::get('{id}',['as'=>'semestres', 'uses'=>'SemestresController@buscarPorId']);
    });
    //Rotas WS Avaliações
    Route::group(['prefix'=>'avaliacoes'], function(){
        //Lista todos os documentos
        Route::get('',['as'=>'avaliacoes', 'uses'=>'AvaliacoesController@buscarTodos']);
        //Busca disciplina por id
        Route::get('{id}',['as'=>'avaliacoes', 'uses'=>'AvaliacoesController@buscarPorId']);
    });
    //Rotas WS Avisos
    Route::group(['prefix'=>'avisos'], function(){
        //Lista todos os avisos
        Route::get('',['as'=>'avisos', 'uses'=>'AvisosController@buscarTodos']);
        //Busca aviso por id
        Route::get('{id}',['as'=>'avisos', 'uses'=>'AvisosController@buscarPorId']);
    });
    //Rotas WS Perguntas
    Route::group(['prefix'=>'perguntas'], function(){
        //Lista todos os avisos
        Route::get('',['as'=>'perguntas', 'uses'=>'PerguntasController@buscarTodos']);
        //Busca aviso por id
        Route::get('{id}',['as'=>'perguntas', 'uses'=>'PerguntasController@buscarPorId']);
    });
});



