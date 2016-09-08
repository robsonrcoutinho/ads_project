<?php

namespace adsproject\Http;

/**Classe responsável por manipular arquivos
 * Class ManipuladorArquivo
 * @package adsproject\Http
 */
class ManipuladorArquivo
{
    /** Método que salva arquivo no servidor
     * @param $arquivo arquivo a ser salvo
     * @param $pasta nome da pasta em que arquivo deverá ser salvo
     * @param $nome nome do arquivo (sem extensão)
     * @return null|string caminho do arquivo ou null se arquivo não tiver sido passado
     */
    public static function salvar($arquivo, $pasta, $nome)
    {
        if ($arquivo != null):                                      //Se arquivo passado não for nulo
            $nome .= '.' . $arquivo->getClientOriginalExtension();  //Acrescenta ao nome do arquivo sua extensão
            // mudança de path para que o arquivo possa ser acessado publicamente
            // atraves da url recebida
            $diretorio = 'public';//storage_path() . '/public/' . $pasta;         //Define o local onde arquivo será salvo
            $arquivo->move($diretorio, $nome);                      //Salva arquivo
            return $diretorio . '/' . $nome;                        //Retorna o caminho do arquivo
        endif;
        return null;
    }

    /** Método que abre ou baixa arquivo
     * @param $arquivo caminho para arquivo
     * @return \Illuminate\Http\Response abre ou baixa arquivo
     */
    public static function abrir($arquivo)
    {
        $nome = explode("/", $arquivo);                             //Transforma o caminho do arquivo em array
        $nome = end($nome);                                         //Pega o nome do arquivo
        $ext = pathinfo($arquivo, PATHINFO_EXTENSION);              //Pega extensão do arquivo
        $cabecalho = [
            'Content-Type' => 'application/' . $ext,
            'Content-Disposition' => 'inline; filename=' . $nome
        ];                                                          //Passa dados para cabeçalho
        return response()->make(file_get_contents($arquivo), 200, $cabecalho);
    }

    /** Método que exclui arquivo
     * @param $arquivo caminho para arquivo a ser excluído
     */
    public static function excluir($arquivo)
    {
        if ($arquivo != null && file_exists($arquivo)):             //Se caminho de arquivo não for nulo e arquivo existir
            unlink($arquivo);                                       //Apaga arquivo
        endif;
    }
}