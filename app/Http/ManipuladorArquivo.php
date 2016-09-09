<?php

namespace adsproject\Http;

/**Classe respons�vel por manipular arquivos
 * Class ManipuladorArquivo
 * @package adsproject\Http
 */
class ManipuladorArquivo
{
    /** M�todo que salva arquivo no servidor
     * @param $arquivo arquivo a ser salvo
     * @param $pasta nome da pasta em que arquivo dever� ser salvo
     * @param $nome nome do arquivo (sem extens�o)
     * @return null|string caminho do arquivo ou null se arquivo n�o tiver sido passado
     */
    public static function salvar($arquivo, $pasta, $nome)
    {
        if ($arquivo != null):                                      //Se arquivo passado n�o for nulo
            $nome .= '.' . $arquivo->getClientOriginalExtension();  //Acrescenta ao nome do arquivo sua extens�o
            // mudan�a de path para que o arquivo possa ser acessado publicamente
            // atraves da url recebida
            $diretorio = 'public';//storage_path() . '/public/' . $pasta;         //Define o local onde arquivo ser� salvo
            $arquivo->move($diretorio, $nome);                      //Salva arquivo
            return $diretorio . '/' . $nome;                        //Retorna o caminho do arquivo
        endif;
        return null;
    }

    /** M�todo que abre ou baixa arquivo
     * @param $arquivo caminho para arquivo
     * @return \Illuminate\Http\Response abre ou baixa arquivo
     */
    public static function abrir($arquivo)
    {
        $nome = explode("/", $arquivo);                             //Transforma o caminho do arquivo em array
        $nome = end($nome);                                         //Pega o nome do arquivo
        $ext = pathinfo($arquivo, PATHINFO_EXTENSION);              //Pega extens�o do arquivo
        $cabecalho = [
            'Content-Type' => 'application/' . $ext,
            'Content-Disposition' => 'inline; filename=' . $nome
        ];                                                          //Passa dados para cabe�alho
        return response()->make(file_get_contents($arquivo), 200, $cabecalho);
    }

    /** M�todo que exclui arquivo
     * @param $arquivo caminho para arquivo a ser exclu�do
     */
    public static function excluir($arquivo)
    {
        if ($arquivo != null && file_exists($arquivo)):             //Se caminho de arquivo n�o for nulo e arquivo existir
            unlink($arquivo);                                       //Apaga arquivo
        endif;
    }
}