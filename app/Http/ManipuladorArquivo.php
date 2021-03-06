<?php

namespace adsproject\Http;

/**Classe respons�vel por manipular arquivos
 * Class ManipuladorArquivo
 * @package adsproject\Http
 */
class ManipuladorArquivo
{
    /** M�todo que salva arquivo no servidor
     * @param $arquivo \Symfony\Component\HttpFoundation\File\UploadedFile arquivo a ser salvo
     * @param $pasta string nome da pasta em que arquivo dever� ser salvo
     * @param $nome string nome do arquivo (sem extens�o)
     * @return null|string caminho do arquivo ou null se arquivo n�o tiver sido passado
     */
    public static function salvar($arquivo, $pasta, $nome)
    {
        if ($arquivo != null):                                      //Se arquivo passado n�o for nulo
            $nome .= '.' . $arquivo->getClientOriginalExtension();  //Acrescenta ao nome do arquivo sua extens�o
            $diretorio = 'public/' . $pasta;                        //Define o local onde arquivo ser� salvo
            $arquivo->move($diretorio, $nome);                      //Salva arquivo
            return $diretorio . '/' . $nome;                        //Retorna o caminho do arquivo
        endif;
        return null;
    }

    /** M�todo que abre ou baixa arquivo
     * @param $arquivo string caminho para arquivo
     * @return \Illuminate\Http\Response abre ou baixa arquivo
     */
    public static function abrir($arquivo)
    {
        $nome = explode("/", $arquivo);                             //Transforma o caminho do arquivo em array
        $nome = end($nome);                                         //Pega o nome do arquivo
        $tipo = \GuzzleHttp\Psr7\mimetype_from_filename($arquivo);  //Pega extens�o do arquivo
                $cabecalho = [
            'Content-Type' => $tipo,
            'Content-Disposition' => 'inline; filename=' . $nome
        ];                                                          //Passa dados para cabe�alho
        //Abre ou baixa arquivo
        return response()->make(file_get_contents($arquivo), 200, $cabecalho);
    }

    /** M�todo que exclui arquivo
     * @param $arquivo string caminho para arquivo a ser exclu�do
     */
    public static function excluir($arquivo)
    {
        if ($arquivo != null && file_exists($arquivo)):             //Se caminho de arquivo n�o for nulo e arquivo existir
            unlink($arquivo);                                       //Apaga arquivo
        endif;
    }
}