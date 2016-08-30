<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;
use PHPExcel_Reader_Excel2007;
use Illuminate\Http\Request;
use adsproject\Disciplina;
use Validator;

/**Classe controller de alunos
 * Class AlunosController
 * @package adsproject\Http\Controllers
 */
class AlunosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Método que redireciona para página inicial de alunos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $alunos = Aluno::orderBy('nome')
            ->paginate(config('constantes.paginacao'));             //busca relação de alunos em ordem alfabética utilizando páginação
        return view('alunos.index', ['alunos' => $alunos]);         //Redireciona para a view com os alunos
    }

    /**Método que redireciona para página de inclusão de novo aluno
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();          //Busca relação de disciplinas em ordem alfabética
        return view('alunos.novo', ['disciplinas' => $disciplinas]);//Redireciona para a view com as disciplinas
    }

    /**Método que inclui novo aluno no sistema
     * @param AlunoRequest $request relação de dados do aluno a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AlunoRequest $request)
    {
        $this->validate($request,
            ['matricula' => 'unique:alunos,matricula',
                'email' => 'unique:alunos,email']);                 //Valida matrícula e email de aluno
        $aluno = Aluno::create($request->all());                    //Cria novo aluno com dados passados
        $disciplinas = $request->get('disciplinas');                //Passa relação de disciplinas do aluno
        if ($disciplinas != null):                                  //Verifica se existem disciplinas passadas
            $aluno->disciplinas()->sync($disciplinas);              //Relaciona as disciplinas ao aluno
        endif;
        return redirect()->route('alunos');                         //Redireciona à página inicial de alunos
    }

    /**
     * Método que redireciona para página de edição de aluno
     * @param $id int identificador do aluno a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $disciplinas = Disciplina::orderBy('nome')->get();              //Busca relação de disciplinas em ordem alfabética
        $aluno = Aluno::find($id);                                      //Busca aluno pelo id
        return view('alunos.editar', compact('aluno', 'disciplinas'));  //Redireciona para a view com as disciplinas e aluno
    }

    /**Método que realiza alteração de dados de aluno
     * @param AlunoRequest $request relação de dados do aluno a ser alterado
     * @param $id int identificador do aluno a ser alterado
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(AlunoRequest $request, $id)
    {
        $this->validate($request,
            ['matricula' => 'unique:alunos,matricula,' . $id,
                'email' => 'unique:alunos,email,' . $id]);          //Valida matrícula e email de aluno
        $aluno = Aluno::find($id);                                  //Busca aluno pelo id
        $disciplinas = $request->get('disciplinas');                //Passa relação de disciplinas do aluno
        if ($disciplinas != null):                                  //Verifica se existem disciplinas passadas
            $aluno->disciplinas()->sync($disciplinas);              //Relaciona as disciplinas ao aluno
        //Verifica, caso lista de disciplinas vazia, se aluno tem relação com alguma disciplina
        elseif ($aluno->disciplinas != null && !$aluno->disciplinas->isEmpty()):
            $aluno->disciplinas()->detach();                        //Remove relação de disciplinas relacionadas com aluno
        endif;
        $aluno->update($request->all());                            //Atualiza dados de aluno
        return redirect()->route('alunos');                         //Redireciona à página inicial de alunos
    }

    /**Método que exclui aluno
     * @param $id int identificador do aluno a ser excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Aluno::find($id)->delete();                             //Busca aluno pelo id e exclui
        return redirect()->route('alunos');                     //Redireciona à página inicial de alunos
    }

    public function buscarTodos()
    {
        return Aluno::all();
    }

    public function buscarPorId($id)
    {
        return Aluno::find($id);
    }

    /**Método que redireciona para página de carregamento de alunos via arquivo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function arquivo()
    {
        return view('alunos.arquivo');                          //Redireciona à página de carregamento de alunos
    }

    /** Método que carrega alunos no sistema a partir de um arquivo
     * @param Request $request contém arquivo com dados de alunos
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function carregar(Request $request)
    {
        $this->validate($request,
            ['arquivo' => 'required'],
            ['required' => 'O :attribute precisa ser passado.']);   //Valida arquivo passado
        $arquivo = $this->gravarArquivo(
            $request->file('arquivo')); //Evoca método para salvar arquivo
        if ($arquivo == null):                                      //Se arquivo nulo (não salvo)
            return redirect()->back()
                ->withErrors(['Ocorreu um erro no arquivo']);       //Retorna a página de carregamento
        endif;
        $salvo = $this->salvarLista($arquivo);                      //Evoca método para salvar lista de alunos
        $this->apagarArquivo($arquivo);                             //Evoca método para apagar arquivo
        /*Redireciona para página inicial de alunos caso a lista tenha sido salva corretamente
        Ou para página anterior caso tenha dado erro ao tentar salvar lista de alunos*/
        return $salvo ? redirect()->route('alunos') :
            redirect()->back()->withErrors(['Ocorreu um erro. Por favor, verifique o arquivo.']);
    }

    /**Método que salva arquivo
     * @param $arquivo \Symfony\Component\HttpFoundation\File\UploadedFile arquivo a ser salvo
     * @return string caminho de acesso ao arquivo
     */
    private function gravarArquivo($arquivo)
    {
        if ($arquivo != null):                                  //Se arquivo passada não for nulo
            $nome = $arquivo->getClientOriginalName();          //Pega o nome original do arquivo
            $diretorio = storage_path() . '/app';               //Define o local onde arquivo será salvo
            $arquivo->move($diretorio, $nome);                  //Salva arquivo
            return $diretorio . '/' . $nome;                    //Retorna o caminho do arquivo
        endif;
        return null;
    }

    /**Método que apaga arquivo
     * @param $arquivo string arquivo a ser apagado
     */
    private function apagarArquivo($arquivo)
    {
        unlink($arquivo);                                       //Apaga arquivo
    }

    /**Método que salva lista de alunos
     * @param $arquivo string caminho de acesso a arquivo que contém dados de alunos
     * @return bool verdadeiro (true) se não houve erro e falso (false) em contrário
     */
    private function salvarLista($arquivo)
    {
        try {                                                           //Tratamento de excessão
            $leitor = new PHPExcel_Reader_Excel2007();                  //Instancia objeto para manipular arquivo Excel
            $planilha = $leitor->load($arquivo);                        //Passa a planilha
            $tabela = $planilha->setActiveSheetIndex(0);                //Passa a tabela com os dados de alunos
            $cont = 2;                                                  //Inicia o contador com número da linha inicial
            $alunos = array();                                          //Cria array para armazenar lista com ids de alunos
            while ($tabela->cellExists('A' . $cont)):                   //Cria estrutura de repetição para percorrer tabela
                $matricula = $tabela->getCell('A' . $cont)->getValue(); //Pega matrícula do aluno
                $nome = $tabela->getCell('B' . $cont)->getValue();      //Pega nome do aluno
                $email = $tabela->getCell('C' . $cont)->getValue();     //Pega e-mail do aluno
                if ($this->validar($matricula, $nome, $email)):         //Verifica validade dos dados passados
                    $aluno = $this->buscarOuCriar($matricula);          //Evoca método para buscar ou criar aluno
                    $aluno->nome = $nome;                               //Passa nome do aluno
                    $aluno->email = $email;                             //Passa e-mail do aluno
                    $aluno->deleted_at = null;                          //Passa null para o atributo deleted_at
                    $aluno->save();                                     //Salva aluno
                    $alunos[] = $aluno->id;                             //Passa id do aluno para array
                    $disciplinas = array();                             //cria um array para armazenar ids de disciplinas
                    do {                                                //Cria estrutura de repetiação para incluir disciplinas
                        //Evoca método para buscar disciplina, pegando id da mesma e passando para array
                        $disciplinas[] = $this->buscarDisciplina($tabela->getCell('D' . $cont)->getValue())->id;
                        $cont++;                                        //Incrementa o contador
                        //Mantém a estrutura de repetição enquanto existir linha seguinte e dados forem do mesmo aluno
                    } while ($tabela->cellExists('A' . $cont) && $tabela->getCell('A' . $cont)->getValue() == null);
                    $aluno->disciplinas()->sync($disciplinas);          //Relaciona disciplinas com aluno
                else:                                                   //Se dados do aluno não forem válidos
                    $cont++;                                            //Incrementa o contador
                endif;
            endwhile;                                                   //Encerra a estrutura de repetição
            //Apaga lista de alunos que não consta no arquivo
            Aluno::destroy(Aluno::all()->except($alunos)->lists('id')->toArray());
        } catch (\Exception $e) {                                       //Caso ocorra um excessão
            return false;                                               //Retorna falso (false)
        }

        return true;                                                    //Retorna verdadeiro (true)
    }

    /**Método que busca aluno pela matrícula e, caso não encontre, cria um nome
     * @param $matricula string matrícula do aluno a ser buscado ou criado
     * @return Aluno|\Illuminate\Database\Eloquent\Model|null|static aluno
     */
    private
    function buscarOuCriar($matricula)
    {
        $aluno = Aluno::withTrashed()->where('matricula', $matricula)->first(); //Busca aluno pela matrícula
        if ($aluno == null):                                                    //Caso não encontre aluno
            $aluno = new Aluno(['matricula' => $matricula]);                    //Cria novo aluno passando a matrícula
        endif;
        return $aluno;                                                          //Retorna o aluno
    }

    /**Método que realiza busca de disciplina pelo código
     * @param $codigo string código da disciplina a ser buscada
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private
    function buscarDisciplina($codigo)
    {
        return Disciplina::query()->where('codigo', $codigo)->first();         //Busca disciplina pelo código
    }

    /**Método que realiza validação de dados de aluno
     * @param $matricula string matrícula do aluno
     * @param $nome string nome do aluno
     * @param $email string e-mail do aluno
     * @return bool verdadeiro (true) se dados estiverem corretos e falso (false) se não
     */
    private
    function validar($matricula, $nome, $email)
    {
        $valores = ['matricula' => trim($matricula),
            'nome' => trim($nome),
            'email' => trim($email)];                           //Passa valores dos dados passados
        $regras = ['matricula' => 'required|min:6|numeric',
            'nome' => 'required|min:5',
            'email' => 'email'];                                //Estabelece as regras de verificação
        $validador = Validator::make($valores, $regras);        //Cria validador
        return !$validador->fails();                            //Verifica se houve falha na validação e retorna o contrário
    }
}