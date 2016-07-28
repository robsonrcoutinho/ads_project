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

/**Classe controller de usuários
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

    /**Método que redireciona para página inicial de usuários
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();                                   //Pega usuário autenticado
        if ($user->role == 'admin'):                            //Verifica se usuário é admin
            $users = User::all();                               //Busca todos os usuário
            return view('users.index', ['users' => $users]);    //Redirecionas para páginal inicial de usuários (users)
        endif;
        return $this->editar($user->id);                        //Redireciona para método de edição
    }

    /**Método que redireciona para página de inclusão de novo usuário
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('users.novo', ['roles' => $this->roles]);   //Redireciona para página de inclusão de usuário
    }

    /**Método que inclui novo usuário no sistema
     * @param UserRequest $request relação de dados do usuário a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(UserRequest $request)
    {
        $this->validate($request,
            ['email' => 'unique:users,email']);                 //Valida e-mail de usuário
        $user = new User($request->all());                      //Cria novo usuário
        $user->password = bcrypt($request->password);           //Passa senha criptografada
        $user->save();                                          //Salva usuário
        return redirect()->route('users');                      //Redireciona para página inicial de usuário
    }

    /**Método que redireciona para página de edição de usuário
     * @param $id identificador do usuário a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $user = User::find($id);                                //Busca usuário pelo id
        //Redireciona para página de edição de usuário
        return view('users.editar', compact('user'), ['roles' => $this->roles]);
    }

    /**Método que realiza alteração de dados de usuário
     * @param UserRequest $request relação de dados do usuário a ser alterado
     * @param $id identificador do aluno a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(UserRequest $request, $id)
    {
        $this->validate($request,
            ['email' => 'unique:users,email,' . $id]);          //Valida e-mail de usuário
        $user = User::find($id);                                //Busca usuário por id
        $user->name=$request->name;                             //Atualiza nome do usuário
        $user->email=$request->email;                           //Atualiza e-mail do usuário
        $user->password = bcrypt($request->password);           //Atualiza senha do usuário
        $user->role=$request->role;                             //Atualiza o papel (role) do usuário
        $user->save();                                          //Salva alterações no usuário
        if (Auth::user()->can('alterar', $user)):               //Verifica se usuário pode realizar alterações em outros usuário
            return redirect()->route('users');                  //Redireciona para página inicial de usuários
        endif;
        return redirect('/');                                   //Redireciona para página inicial do sistema

    }

    /**Método que exclui usuário
     * @param $id identificador do usuário a ser excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        User::find($id)->delete();                          //Busca usuário por id e exclui
        return redirect()->route('users');                  //Redireciona para página inicial de usuários
    }
}