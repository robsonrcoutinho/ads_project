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
    return view('inicio');
});
//Rotas de professores
Route::group(['prefix'=>'professores', 'where'=>['matricula'=>'[0-9]+']], function(){
//Rota para IndexProfessor
    Route::get('', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
   //Route::get('professores', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
//Rota para novo professor
    Route::get('novo',['as'=>'professores.novo', 'uses'=> 'ProfessoresController@novo']);
//Rota para salvar professor
    Route::post('salvar', ['as'=>'professores.salvar', 'uses'=>'ProfessoresController@salvar']);
//Rota para exluir professor
    Route::get('{matricula}/excluir',['as'=>'professores.excluir', 'uses'=> 'ProfessoresController@excluir']);
//Rota para edi��o de professor
    Route::get('{matricula}/editar',['as'=>'professores.editar', 'uses'=>'ProfessoresController@editar']);
//Rota para altera��o de professor
    Route::put('{matricula}/alterar',['as'=>'professores.alterar', 'uses'=> 'ProfessoresController@alterar']);

});
//Rotas de disciplinas
Route::group(['prefix'=>'disciplinas'], function(){
//Rota para IndexDisciplina
    Route::get('', ['as'=>'disciplinas', 'uses' =>'DisciplinasController@index']);
//Rota para nova disciplina
    Route::get('novo',['as'=>'disciplinas.novo', 'uses'=> 'DisciplinasController@novo']);
//Rota para salvar disciplina
    Route::post('salvar', ['as'=>'disciplinas.salvar', 'uses'=>'DisciplinasController@salvar']);
//Rota para exluir disciplina
    Route::get('{codigo}/excluir',['as'=>'disciplinas.excluir', 'uses'=> 'DisciplinasController@excluir']);
//Rota para editar disciplina
    Route::get('{codigo}/editar',['as'=>'disciplinas.editar', 'uses'=>'DisciplinasController@editar']);
//Rota para alterar disciplina
    Route::put('{codigo}/alterar',['as'=>'disciplinas.alterar', 'uses'=> 'DisciplinasController@alterar']);
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
Route::group(['prefix'=>'semestres'], function(){
//Rota para IndexSemestre
    Route::get('', ['as'=>'semestres', 'uses' =>'SemestresController@index']);
//Rota para novo semestre
    Route::get('novo',['as'=>'semestres.novo', 'uses'=> 'SemestresController@novo']);
//Rota para salvar semestre
    Route::post('salvar', ['as'=>'semestres.salvar', 'uses'=>'SemestresController@salvar']);
//Rota para exluir semestre
    //Route::get('{codigo}/excluir',['as'=>'Semestres.excluir', 'uses'=> 'SemestresController@excluir']);
//Rota para editar semestre
    Route::get('{codigo}/editar',['as'=>'semestres.editar', 'uses'=>'SemestresController@editar']);
//Rota para alterar semestre
    Route::put('{codigo}/alterar',['as'=>'semestres.alterar', 'uses'=> 'SemestresController@alterar']);
});