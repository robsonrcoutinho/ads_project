<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;
use PHPExcel_Reader_Excel2007;
use Illuminate\Http\Request;
use adsproject\Disciplina;
use Validator;


class AlunosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alunos = Aluno::orderBy('nome')->get();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();
        return view('alunos.novo', ['disciplinas' => $disciplinas]);
    }

    public function salvar(AlunoRequest $request)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula',
            'email' => 'unique:alunos,email']);
        $aluno = Aluno::create($request->all());
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $aluno->disciplinas()->sync($disciplinas);
        endif;
        return redirect()->route('alunos');
    }

    public function editar($id)
    {
        $disciplinas = Disciplina::orderBy('nome')->get();
        $aluno = Aluno::find($id);
        return view('alunos.editar', compact('aluno', 'disciplinas'));
    }

    public function alterar(AlunoRequest $request, $id)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula,' . $id,
            'email' => 'unique:alunos,email,' . $id]);
        $aluno = Aluno::find($id);
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $aluno->disciplinas()->sync($disciplinas);
        elseif ($aluno->disciplinas != null && !$aluno->disciplinas->isEmpty()):
            $aluno->disciplinas()->detach($aluno->disciplinas);
        endif;
        $aluno->update($request->all());
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

    public function carregar(Request $request)
    {
        $this->validate($request, ['arquivo' => 'required'], ['required' => 'O :attribute precisa ser passado.']);
        $arquivo = $this->gravarArquivo($request->file('arquivo'));
        if ($arquivo == null):
            return redirect()->back()->withErrors(['Ocorreu um erro no arquivo']);
        endif;
        /*list($usec, $sec) = explode(' ', microtime());
        $script_start = (float)$sec + (float)$usec;*/
        $salvo = $this->salvarLista($arquivo);
        /*list($usec, $sec) = explode(' ', microtime());
        $script_end = (float)$sec + (float)$usec;
        $elapsed_time = round($script_end - $script_start, 5);*/
        $this->apagarArquivo($arquivo);
        //$texto='Elapsed time: '. $elapsed_time. ' secs. Memory usage: '. round(((memory_get_peak_usage(true) / 1024) / 1024), 2). 'Mb';
        //dd($texto);
        return $salvo ? redirect()->route('alunos') :
            redirect()->back()->withErrors(['Ocorreu um erro. Por favor, verifique o arquivo.']);

    }

    private function gravarArquivo($arquivo)
    {
        if ($arquivo != null):
            $nome = $arquivo->getClientOriginalName();
            $diretorio = storage_path() . '/app';
            $arquivo->move($diretorio, $nome);
            return $diretorio . '/' . $nome;
        endif;
    }

    private function apagarArquivo($arquivo)
    {
        unlink($arquivo);
    }

    private function salvarLista($arquivo)
    {
        try {
            $leitor = new PHPExcel_Reader_Excel2007();
            $planilha = $leitor->load($arquivo);
            $tabela = $planilha->setActiveSheetIndex(0);
            $cont = 2;
            $alunos = array();
            while ($tabela->cellExists('A' . $cont)):
                $matricula = $tabela->getCell('A' . $cont)->getValue();
                $aluno = $this->buscarOuCriar($matricula);
                $aluno->nome = $tabela->getCell('B' . $cont)->getValue();
                $aluno->email = $tabela->getCell('C' . $cont)->getValue();
                $aluno->deleted_at = null;
                $aluno->save();
                $alunos[] = $aluno->id;
                $disciplinas = array();
                do {
                    $disciplinas[] = $this->buscarDisciplina($tabela->getCell('D' . $cont)->getValue())->id;
                    $cont++;
                } while ($tabela->cellExists('A' . $cont) && $tabela->getCell('A' . $cont)->getValue() == null);
                $aluno->disciplinas()->sync($disciplinas);
            endwhile;
            Aluno::destroy(Aluno::all()->except($alunos)->lists('id')->toArray());
        } catch (\Exception $e) {
            return false;
        }
        return true;
        /*
                try {
                    $leitor = new PHPExcel_Reader_Excel2007();
                    $planilha = $leitor->load($arquivo);
                    $tabela = $planilha->setActiveSheetIndex(0);
                    $lista = $tabela->toArray();
                    $tamanho = count($lista);
                    $cont = 1;
                    $alunos = array();
                    //dd($lista[2][0]);
                    while ($cont < $tamanho):
                        $matricula = $lista[$cont][0];
                        $aluno = $this->buscarOuCriar($matricula);
                        $aluno->nome = $lista[$cont][1];
                        $aluno->email = $lista[$cont][2];
                        $aluno->deleted_at = null;
                        $aluno->save();
                        $alunos[] = $aluno->id;
                        $disciplinas = array();
                        do {
                            $disciplinas[] = $this->buscarDisciplina($lista[$cont][3])->id;
                            $cont++;
                        } while ($cont < $tamanho && $lista[$cont][0] == null);
                        $aluno->disciplinas()->sync($disciplinas);
                    endwhile;
                    Aluno::destroy(Aluno::all()->except($alunos)->lists('id')->toArray());
                } catch (\Exception $e) {
                    return false;
                }
                return true;*/

    }

    private function buscarOuCriar($matricula)
    {
        $aluno = Aluno::withTrashed()->where('matricula', $matricula)->first();
        if ($aluno == null):
            $aluno = new Aluno(['matricula' => $matricula]);
        endif;
        return $aluno;
    }

    private
    function buscarDisciplina($codigo)
    {
        return Disciplina::query()->where('codigo', $codigo)->first();
    }

    private
    function montarLista($texto)
    {
        if ($texto == null):
            return;
        endif;
        $linhas = explode("\n", $texto);
        foreach ($linhas as $linha):
            $dados = explode("|", $linha);

            //foreach ($texto as $dados):
            //dd($dados['matricula']);
            //foreach ($texto as $dados):
            //$dado=get_object_vars($dados);
            if (count($dados) >= 3):
                if ($this->validar($dados[0], $dados[1], $dados[2])):
                    //if ($this->validar($dados['matricula'], $dados['nome'], $dados['email'])):
                    //if ($this->validar($dados->matricula, $dados->nome, $dados->email)):
                    $this->gravar($dados);
                endif;
            endif;
        endforeach;
    }

    private
    function validar($matricula, $nome, $email)
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

    private
    function gravar($dados)
    {
        //$aluno = Aluno::query()->where('matricula', $dados[0])->first();
        //$aluno = Aluno::query()->where('matricula', $dados['matricula'])->first();
        $aluno = Aluno::withTrashed()->where('matricula', $dados[0])->first();
        if ($aluno == null):
            $aluno = new Aluno();
        endif;
        $aluno->matricula = trim($dados[0]);
        $aluno->nome = trim($dados[1]);
        $aluno->email = trim($dados[2]);
        /*$aluno->matricula = trim($dados['matricula']);
        $aluno->nome = trim($dados['nome']);
        $aluno->email = trim($dados['email']);*/
        /*$aluno->matricula = trim($dados->matricula);
        $aluno->nome = trim($dados->nome);
        $aluno->email = trim($dados->email);*/
        $aluno->deleted_at = null;
        $disciplinas = array();
        if (count($dados) > 3):
            for ($i = 3; $i < count($dados); $i++):
                //dd($dados);
                $disciplina = Disciplina::query()->where('codigo', trim($dados[$i]))->lists('id')->first();
                $disciplinas[] = $disciplina;
                //dd($disciplinas);
            endfor;
            //dd($disciplinas);
        endif;
        $aluno->save();
        $aluno->disciplinas()->sync($disciplinas);
    }
}