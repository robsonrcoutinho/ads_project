<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

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
            $texto = $filesystem->get($nomeArquivo);
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
            $this->gravar($dados);
        endforeach;
    }

    private function gravar($dados)
    {

        $alunos = Aluno::query()->where('matricula', $dados[0])->first();
        if ($alunos == null):
            $aluno = new Aluno();
            $aluno->matricula = $dados[0];
            $aluno->nome = $dados[1];
            $aluno->email = $dados[2];
            $aluno->save();
        else:
            $aluno = $alunos;
            $aluno->matricula = $dados[0];
            $aluno->nome = $dados[1];
            $aluno->email = $dados[2];
            $aluno->save();
        endif;
    }
}