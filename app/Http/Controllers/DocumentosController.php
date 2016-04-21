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
}