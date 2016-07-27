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
        $salvo = $this->salvarLista($arquivo);
        $this->apagarArquivo($arquivo);
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
                $nome = $tabela->getCell('B' . $cont)->getValue();
                $email = $tabela->getCell('C' . $cont)->getValue();
                if ($this->validar($matricula, $nome, $email)):
                    $aluno = $this->buscarOuCriar($matricula);
                    $aluno->nome = $nome;
                    $aluno->email = $email;
                    $aluno->deleted_at = null;
                    $aluno->save();
                    $alunos[] = $aluno->id;
                    $disciplinas = array();
                    do {
                        $disciplinas[] = $this->buscarDisciplina($tabela->getCell('D' . $cont)->getValue())->id;
                        $cont++;
                    } while ($tabela->cellExists('A' . $cont) && $tabela->getCell('A' . $cont)->getValue() == null);
                    $aluno->disciplinas()->sync($disciplinas);
                else:
                    $cont++;
                endif;
            endwhile;
            Aluno::destroy(Aluno::all()->except($alunos)->lists('id')->toArray());
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    private function buscarOuCriar($matricula)
    {
        $aluno = Aluno::withTrashed()->where('matricula', $matricula)->first();
        if ($aluno == null):
            $aluno = new Aluno(['matricula' => $matricula]);
        endif;
        return $aluno;
    }

    private function buscarDisciplina($codigo)
    {
        return Disciplina::query()->where('codigo', $codigo)->first();
    }

    private function validar($matricula, $nome, $email)
    {
        $valores = ['matricula' => trim($matricula),
            'nome' => trim($nome),
            'email' => trim($email)];
        $regras = ['matricula' => 'required|min:6|numeric',
            'nome' => 'required|min:5',
            'email' => 'email'];
        $validador = Validator::make($valores, $regras);
        return !$validador->fails();
    }
}