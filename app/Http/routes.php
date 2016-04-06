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
//Rota para IndexProfessor
    Route::get('', ['as'=>'disciplinas', 'uses' =>'DisciplinasController@index']);
//Rota para novo professor
    Route::get('novo',['as'=>'disciplinas.novo', 'uses'=> 'DisciplinasController@novo']);
//Rota para salvar professor
    Route::post('salvar', ['as'=>'disciplinas.salvar', 'uses'=>'DisciplinasController@salvar']);
//Rota para exluir professor
    Route::get('{codigo}/excluir',['as'=>'disciplinas.excluir', 'uses'=> 'DisciplinasController@excluir']);

//Rota para edi��o de professor
    Route::get('{codigo}/editar',['as'=>'disciplinas.editar', 'uses'=>'DisciplinasController@editar']);
//Rota para altera��o de professor
    Route::put('{codigo}/alterar',['as'=>'disciplinas.alterar', 'uses'=> 'DisciplinasController@alterar']);

});