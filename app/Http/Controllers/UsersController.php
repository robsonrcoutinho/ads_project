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

class UsersController extends Controller
{
    private $roles = ['aluno' => 'aluno', 'professor' => 'professor', 'admin' => 'admin'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin'):
            $users = User::all();
            return view('users.index', ['users' => $users]);
        endif;
        return $this->editar($user->id);
    }

    public function novo()
    {
        return view('users.novo', ['roles' => $this->roles]);
    }

    public function salvar(UserRequest $request)
    {
        $this->validate($request, ['email' => 'unique:users,email']);
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users');
    }

    public function editar($id)
    {
        $user = User::find($id);
        //$this->authorize('update', $user);
        return view('users.editar', compact('user'), ['roles' => $this->roles]);
    }

    public function alterar(UserRequest $request, $id)
    {
        $this->validate($request, ['email' => 'unique:users,email,' . $id]);
        $user = User::find($id);
        $user->fillable($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users');
    }

    public function excluir($id)
    {
        User::find($id)->delete();
        return redirect()->route('users');
    }
}