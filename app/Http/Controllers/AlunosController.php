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
        if ($arquivo != null):
            //dd($caminho);
            $nomeArquivo = $arquivo->getClientOriginalName();
            $diretorio = storage_path() . '/app';
            $arquivo->move($diretorio, $nomeArquivo);
            if ($filesystem->exists($nomeArquivo)):
                $texto = utf8_encode($filesystem->get($nomeArquivo));
                //$texto = json_decode(utf8_encode($filesystem->get($nomeArquivo)), true);
                //            dd(xml_error_string($texto));
                try {
                    $xml = simplexml_load_string($texto);
                    $this->montarLista($xml);
                    //dd($xml);
                } catch (\Exception $e) {

                }
                unlink($diretorio . '/' . $nomeArquivo);
//$this->montarLista($texto);
//$this->montarLista($xml);
            endif;
        endif;
        return redirect()->route('alunos');
    }

    private function montarLista($texto)
    {
        /*$linhas = explode("\n", $texto);
        foreach ($linhas as $linha):
            $dados = explode("|", $linha);*/
        //dd($texto);
        if ($texto == null):
            return;
        endif;
        //foreach ($texto as $dados):
        //dd($dados['matricula']);
        foreach ($texto as $dados):
            //$dado=get_object_vars($dados);
            if (count($dados) >= 3):
                //if ($this->validar($dados[0], $dados[1], $dados[2])):
                //if ($this->validar($dados['matricula'], $dados['nome'], $dados['email'])):
                if ($this->validar($dados->matricula, $dados->nome, $dados->email)):
                    $this->gravar($dados);
                endif;
            endif;
        endforeach;
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

    private function gravar($dados)
    {
        //$aluno = Aluno::query()->where('matricula', $dados[0])->first();
        //$aluno = Aluno::query()->where('matricula', $dados['matricula'])->first();
        $aluno = Aluno::withTrashed()->where('matricula', $dados->matricula)->first();
        if ($aluno == null):
            $aluno = new Aluno();
        endif;
        /*$aluno->matricula = trim($dados[0]);
        $aluno->nome = trim($dados[1]);
        $aluno->email = trim($dados[2]);*/
        /*$aluno->matricula = trim($dados['matricula']);
        $aluno->nome = trim($dados['nome']);
        $aluno->email = trim($dados['email']);*/
        $aluno->matricula = trim($dados->matricula);
        $aluno->nome = trim($dados->nome);
        $aluno->email = trim($dados->email);
        $aluno->deleted_at = null;
        $aluno->save();
    }
}