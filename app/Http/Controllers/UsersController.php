<?php
namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/06/2016
 * Time: 09:22
 */

use adsproject\User;
use adsproject\Http\Requests\UserRequest;
use Auth;

/**Classe controller de usu�rios
 * Class UsersController
 * @package adsproject\Http\Controllers
 */
class UsersController extends Controller
{
    private $roles = ['aluno' => 'aluno', 'professor' => 'professor', 'admin' => 'admin'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**M�todo que redireciona para p�gina inicial de usu�rios
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();                                   //Pega usu�rio autenticado
        if ($user->role == 'admin'):                            //Verifica se usu�rio � admin
            $users = User::all();                               //Busca todos os usu�rio
            return view('users.index', ['users' => $users]);    //Redirecionas para p�ginal inicial de usu�rios (users)
        endif;
        return $this->editar($user->id);                        //Redireciona para m�todo de edi��o
    }

    /**M�todo que redireciona para p�gina de inclus�o de novo usu�rio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('users.novo', ['roles' => $this->roles]);   //Redireciona para p�gina de inclus�o de usu�rio
    }

    /**M�todo que inclui novo usu�rio no sistema
     * @param UserRequest $request rela��o de dados do usu�rio a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(UserRequest $request)
    {
        $this->validate($request,
            ['email' => 'unique:users,email']);                 //Valida e-mail de usu�rio
        $user = new User($request->all());                      //Cria novo usu�rio
        $user->password = bcrypt($request->password);           //Passa senha criptografada
        $user->save();                                          //Salva usu�rio
        return redirect()->route('users');                      //Redireciona para p�gina inicial de usu�rio
    }

    /**M�todo que redireciona para p�gina de edi��o de usu�rio
     * @param $id identificador do usu�rio a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $user = User::find($id);                                //Busca usu�rio pelo id
        //Redireciona para p�gina de edi��o de usu�rio
        return view('users.editar', compact('user'), ['roles' => $this->roles]);
    }

    /**M�todo que realiza altera��o de dados de usu�rio
     * @param UserRequest $request rela��o de dados do usu�rio a ser alterado
     * @param $id identificador do aluno a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(UserRequest $request, $id)
    {
        $this->validate($request,
            ['email' => 'unique:users,email,' . $id]);          //Valida e-mail de usu�rio
        $user = User::find($id);                                //Busca usu�rio por id
        $user->name=$request->name;                             //Atualiza nome do usu�rio
        $user->email=$request->email;                           //Atualiza e-mail do usu�rio
        $user->password = bcrypt($request->password);           //Atualiza senha do usu�rio
        $user->role=$request->role;                             //Atualiza o papel (role) do usu�rio
        $user->save();                                          //Salva altera��es no usu�rio
        if (Auth::user()->can('alterar', $user)):               //Verifica se usu�rio pode realizar altera��es em outros usu�rio
            return redirect()->route('users');                  //Redireciona para p�gina inicial de usu�rios
        endif;
        return redirect('/');                                   //Redireciona para p�gina inicial do sistema

    }

    /**M�todo que exclui usu�rio
     * @param $id identificador do usu�rio a ser exclu�do
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        User::find($id)->delete();                          //Busca usu�rio por id e exclui
        return redirect()->route('users');                  //Redireciona para p�gina inicial de usu�rios
    }
}