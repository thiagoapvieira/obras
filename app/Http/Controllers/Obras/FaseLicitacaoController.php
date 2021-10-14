<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class FaseLicitacaoController extends Controller
{
    public function index()
    {
      $fase_licitacao = DB::table('fase_licitacao')->get();
      return view('fase_licitacao.fase_licitacao',['fase_licitacao'=>$fase_licitacao]);
    }

    public function create()
    {
      $fase_licitacao = DB::table('fase_licitacao')->get();
      return view('fase_licitacao.fase_licitacao_frm',['fase_licitacao'=>$fase_licitacao]);
    }

    public function save(Request $request)
    {
      $n = DB::table('fase_licitacao')->insertGetId(
        ['nome' => $request->nome, ]
      );       

      return redirect('/fase_licitacao/')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {      
      $fase_licitacao = DB::table('fase_licitacao')->where('id', $id)->first();      

      return view('fase_licitacao.fase_licitacao_frm',['fase_licitacao'=>$fase_licitacao]);      
    }

    public function update(Request $request, $id)
    {
      DB::table('fase_licitacao') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('/fase_licitacao/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');      
    }


    public function delete($id){
      DB::table('fase_licitacao')->where('id', $id)->delete();
      
      return redirect('/fase_licitacao');
    }

}
