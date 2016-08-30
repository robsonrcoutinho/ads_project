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
     * M�todo que redireciona para p�gina inicial de alunos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $alunos = Aluno::orderBy('nome')
            ->paginate(config('constantes.paginacao'));             //busca rela��o de alunos em ordem alfab�tica utilizando p�gina��o
        return view('alunos.index', ['alunos' => $alunos]);         //Redireciona para a view com os alunos
    }

    /**M�todo que redireciona para p�gina de inclus�o de novo aluno
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();          //Busca rela��o de disciplinas em ordem alfab�tica
        return view('alunos.novo', ['disciplinas' => $disciplinas]);//Redireciona para a view com as disciplinas
    }

    /**M�todo que inclui novo aluno no sistema
     * @param AlunoRequest $request rela��o de dados do aluno a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AlunoRequest $request)
    {
        $this->validate($request,
            ['matricula' => 'unique:alunos,matricula',
                'email' => 'unique:alunos,email']);                 //Valida matr�cula e email de aluno
        $aluno = Aluno::create($request->all());                    //Cria novo aluno com dados passados
        $disciplinas = $request->get('disciplinas');                //Passa rela��o de disciplinas do aluno
        if ($disciplinas != null):                                  //Verifica se existem disciplinas passadas
            $aluno->disciplinas()->sync($disciplinas);              //Relaciona as disciplinas ao aluno
        endif;
        return redirect()->route('alunos');                         //Redireciona � p�gina inicial de alunos
    }

    /**
     * M�todo que redireciona para p�gina de edi��o de aluno
     * @param $id int identificador do aluno a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $disciplinas = Disciplina::orderBy('nome')->get();              //Busca rela��o de disciplinas em ordem alfab�tica
        $aluno = Aluno::find($id);                                      //Busca aluno pelo id
        return view('alunos.editar', compact('aluno', 'disciplinas'));  //Redireciona para a view com as disciplinas e aluno
    }

    /**M�todo que realiza altera��o de dados de aluno
     * @param AlunoRequest $request rela��o de dados do aluno a ser alterado
     * @param $id int identificador do aluno a ser alterado
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(AlunoRequest $request, $id)
    {
        $this->validate($request,
            ['matricula' => 'unique:alunos,matricula,' . $id,
                'email' => 'unique:alunos,email,' . $id]);          //Valida matr�cula e email de aluno
        $aluno = Aluno::find($id);                                  //Busca aluno pelo id
        $disciplinas = $request->get('disciplinas');                //Passa rela��o de disciplinas do aluno
        if ($disciplinas != null):                                  //Verifica se existem disciplinas passadas
            $aluno->disciplinas()->sync($disciplinas);              //Relaciona as disciplinas ao aluno
        //Verifica, caso lista de disciplinas vazia, se aluno tem rela��o com alguma disciplina
        elseif ($aluno->disciplinas != null && !$aluno->disciplinas->isEmpty()):
            $aluno->disciplinas()->detach();                        //Remove rela��o de disciplinas relacionadas com aluno
        endif;
        $aluno->update($request->all());                            //Atualiza dados de aluno
        return redirect()->route('alunos');                         //Redireciona � p�gina inicial de alunos
    }

    /**M�todo que exclui aluno
     * @param $id int identificador do aluno a ser exclu�do
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Aluno::find($id)->delete();                             //Busca aluno pelo id e exclui
        return redirect()->route('alunos');                     //Redireciona � p�gina inicial de alunos
    }

    public function buscarTodos()
    {
        return Aluno::all();
    }

    public function buscarPorId($id)
    {
        return Aluno::find($id);
    }

    /**M�todo que redireciona para p�gina de carregamento de alunos via arquivo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function arquivo()
    {
        return view('alunos.arquivo');                          //Redireciona � p�gina de carregamento de alunos
    }

    /** M�todo que carrega alunos no sistema a partir de um arquivo
     * @param Request $request cont�m arquivo com dados de alunos
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function carregar(Request $request)
    {
        $this->validate($request,
            ['arquivo' => 'required'],
            ['required' => 'O :attribute precisa ser passado.']);   //Valida arquivo passado
        $arquivo = $this->gravarArquivo(
            $request->file('arquivo')); //Evoca m�todo para salvar arquivo
        if ($arquivo == null):                                      //Se arquivo nulo (n�o salvo)
            return redirect()->back()
                ->withErrors(['Ocorreu um erro no arquivo']);       //Retorna a p�gina de carregamento
        endif;
        $salvo = $this->salvarLista($arquivo);                      //Evoca m�todo para salvar lista de alunos
        $this->apagarArquivo($arquivo);                             //Evoca m�todo para apagar arquivo
        /*Redireciona para p�gina inicial de alunos caso a lista tenha sido salva corretamente
        Ou para p�gina anterior caso tenha dado erro ao tentar salvar lista de alunos*/
        return $salvo ? redirect()->route('alunos') :
            redirect()->back()->withErrors(['Ocorreu um erro. Por favor, verifique o arquivo.']);
    }

    /**M�todo que salva arquivo
     * @param $arquivo \Symfony\Component\HttpFoundation\File\UploadedFile arquivo a ser salvo
     * @return string caminho de acesso ao arquivo
     */
    private function gravarArquivo($arquivo)
    {
        if ($arquivo != null):                                  //Se arquivo passada n�o for nulo
            $nome = $arquivo->getClientOriginalName();          //Pega o nome original do arquivo
            $diretorio = storage_path() . '/app';               //Define o local onde arquivo ser� salvo
            $arquivo->move($diretorio, $nome);                  //Salva arquivo
            return $diretorio . '/' . $nome;                    //Retorna o caminho do arquivo
        endif;
        return null;
    }

    /**M�todo que apaga arquivo
     * @param $arquivo string arquivo a ser apagado
     */
    private function apagarArquivo($arquivo)
    {
        unlink($arquivo);                                       //Apaga arquivo
    }

    /**M�todo que salva lista de alunos
     * @param $arquivo string caminho de acesso a arquivo que cont�m dados de alunos
     * @return bool verdadeiro (true) se n�o houve erro e falso (false) em contr�rio
     */
    private function salvarLista($arquivo)
    {
        try {                                                           //Tratamento de excess�o
            $leitor = new PHPExcel_Reader_Excel2007();                  //Instancia objeto para manipular arquivo Excel
            $planilha = $leitor->load($arquivo);                        //Passa a planilha
            $tabela = $planilha->setActiveSheetIndex(0);                //Passa a tabela com os dados de alunos
            $cont = 2;                                                  //Inicia o contador com n�mero da linha inicial
            $alunos = array();                                          //Cria array para armazenar lista com ids de alunos
            while ($tabela->cellExists('A' . $cont)):                   //Cria estrutura de repeti��o para percorrer tabela
                $matricula = $tabela->getCell('A' . $cont)->getValue(); //Pega matr�cula do aluno
                $nome = $tabela->getCell('B' . $cont)->getValue();      //Pega nome do aluno
                $email = $tabela->getCell('C' . $cont)->getValue();     //Pega e-mail do aluno
                if ($this->validar($matricula, $nome, $email)):         //Verifica validade dos dados passados
                    $aluno = $this->buscarOuCriar($matricula);          //Evoca m�todo para buscar ou criar aluno
                    $aluno->nome = $nome;                               //Passa nome do aluno
                    $aluno->email = $email;                             //Passa e-mail do aluno
                    $aluno->deleted_at = null;                          //Passa null para o atributo deleted_at
                    $aluno->save();                                     //Salva aluno
                    $alunos[] = $aluno->id;                             //Passa id do aluno para array
                    $disciplinas = array();                             //cria um array para armazenar ids de disciplinas
                    do {                                                //Cria estrutura de repetia��o para incluir disciplinas
                        //Evoca m�todo para buscar disciplina, pegando id da mesma e passando para array
                        $disciplinas[] = $this->buscarDisciplina($tabela->getCell('D' . $cont)->getValue())->id;
                        $cont++;                                        //Incrementa o contador
                        //Mant�m a estrutura de repeti��o enquanto existir linha seguinte e dados forem do mesmo aluno
                    } while ($tabela->cellExists('A' . $cont) && $tabela->getCell('A' . $cont)->getValue() == null);
                    $aluno->disciplinas()->sync($disciplinas);          //Relaciona disciplinas com aluno
                else:                                                   //Se dados do aluno n�o forem v�lidos
                    $cont++;                                            //Incrementa o contador
                endif;
            endwhile;                                                   //Encerra a estrutura de repeti��o
            //Apaga lista de alunos que n�o consta no arquivo
            Aluno::destroy(Aluno::all()->except($alunos)->lists('id')->toArray());
        } catch (\Exception $e) {                                       //Caso ocorra um excess�o
            return false;                                               //Retorna falso (false)
        }

        return true;                                                    //Retorna verdadeiro (true)
    }

    /**M�todo que busca aluno pela matr�cula e, caso n�o encontre, cria um nome
     * @param $matricula string matr�cula do aluno a ser buscado ou criado
     * @return Aluno|\Illuminate\Database\Eloquent\Model|null|static aluno
     */
    private
    function buscarOuCriar($matricula)
    {
        $aluno = Aluno::withTrashed()->where('matricula', $matricula)->first(); //Busca aluno pela matr�cula
        if ($aluno == null):                                                    //Caso n�o encontre aluno
            $aluno = new Aluno(['matricula' => $matricula]);                    //Cria novo aluno passando a matr�cula
        endif;
        return $aluno;                                                          //Retorna o aluno
    }

    /**M�todo que realiza busca de disciplina pelo c�digo
     * @param $codigo string c�digo da disciplina a ser buscada
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private
    function buscarDisciplina($codigo)
    {
        return Disciplina::query()->where('codigo', $codigo)->first();         //Busca disciplina pelo c�digo
    }

    /**M�todo que realiza valida��o de dados de aluno
     * @param $matricula string matr�cula do aluno
     * @param $nome string nome do aluno
     * @param $email string e-mail do aluno
     * @return bool verdadeiro (true) se dados estiverem corretos e falso (false) se n�o
     */
    private
    function validar($matricula, $nome, $email)
    {
        $valores = ['matricula' => trim($matricula),
            'nome' => trim($nome),
            'email' => trim($email)];                           //Passa valores dos dados passados
        $regras = ['matricula' => 'required|min:6|numeric',
            'nome' => 'required|min:5',
            'email' => 'email'];                                //Estabelece as regras de verifica��o
        $validador = Validator::make($valores, $regras);        //Cria validador
        return !$validador->fails();                            //Verifica se houve falha na valida��o e retorna o contr�rio
    }
}