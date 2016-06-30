<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Validator;

class AlunosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function novo()
    {
        return view('alunos.novo');
    }

    public function salvar(AlunoRequest $request)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula',
            'email' => 'unique:alunos,email']);
        Aluno::create($request->all());
        return redirect()->route('alunos');
    }

    public function editar($id)
    {
        $aluno = Aluno::find($id);
        return view('alunos.editar', compact('aluno'));
    }

    public function alterar(AlunoRequest $request, $id)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula,' . $id,
            'email' => 'unique:alunos,email,' . $id]);
        Aluno::find($id)->update($request->all());
        return redirect()->route('alunos');
    }

    public function excluir($id)
    {
        Aluno::find($id)->delete();
        return redirect()->route('alunos');
    }

    public function buscarTodos()
    {
        return Aluno::all();
    }

    public function buscarPorId($id)
    {
        return Aluno::find($id);
    }

    public function arquivo()
    {
        return view('alunos.arquivo');
    }

    public function carregar(Filesystem $filesystem, Request $request)
    {
        $arquivo = $request->file('arquivo');
        $nomeArquivo = $arquivo->getClientOriginalName();
        $diretorio = storage_path() . '/app';
        $arquivo->move($diretorio, $nomeArquivo);
        if ($filesystem->exists($nomeArquivo)):
            $texto = utf8_encode($filesystem->get($nomeArquivo));
            unlink($diretorio . '/' . $nomeArquivo);
            $this->montarLista($texto);
        endif;
        return redirect()->route('alunos');
    }

    private function montarLista($texto)
    {
        $linhas = explode("\n", $texto);
        foreach ($linhas as $linha):
            $dados = explode("|", $linha);

            if (count($dados) >= 3):
                if ($this->validar($dados[0], $dados[1], $dados[2])):
                    $this->gravar($dados);
                endif;
            endif;
        endforeach;
    }

    private function gravar($dados)
    {
        $aluno = Aluno::query()->where('matricula', $dados[0])->first();
        //dd(utf8_encode($dados[1]));
        if ($aluno == null):
            $aluno = new Aluno();
        endif;
        $aluno->matricula = trim($dados[0]);
        $aluno->nome = trim($dados[1]);
        $aluno->email = trim($dados[2]);
        $aluno->save();
    }

    private function validar($matricula, $nome, $email)
    {
        $valores = ['matricula' => trim($matricula),
            'nome' => trim($nome),
            'email' => trim($email)];
        $regras = ['matricula' => 'required|min:6',
            'nome' => 'required|min:5',
            'email' => 'email'];
        $validador = Validator::make($valores, $regras);
        return !$validador->fails();
    }
}