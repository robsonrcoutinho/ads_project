<?php  namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 23/03/2016
 * Time: 08:45
 */
use adsproject\Documento;
use adsproject\Http\Requests\DocumentoRequest;

class DocumentosController extends Controller{

    public function index(){
        $documentos = Documento::all();
        return view('documentos.index', ['documentos'=>$documentos]);
    }
    public function novo(){
        return view('documentos.novo');
    }
    public function salvar(DocumentoRequest $request){
        $documento = $request->all();
        Documento::create($documento);
        return redirect()->route('documentos');
    }
    public function editar($id){
        $documento = Documento::find($id);
        return view('documentos.editar', compact('documento'));
    }
    public function alterar(DocumentoRequest $request, $id){
        Documento::find($id)->update($request->all());
        return redirect('documentos');
    }
    public function excluir($id){
        Documento::find($id)->delete();
        return redirect()->route('documentos');
    }
    //Métodos do Web Service
    //Método que busca todos os documentos para o Web Service
    public function buscarTodos(){
        return Documento::all();
    }
    //Método que busca documento por id para o Web Service
    public function buscarPorId($id){
        return Documento::find($id);
    }
    public function buscarPorTitulo($titulo){
        $documentos = Documento::where('titulo', $titulo)->get();
        return $documentos;
    }
}