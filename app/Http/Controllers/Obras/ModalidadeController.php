<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ModalidadeController extends Controller
{
    public function index()
    {
      $modalidade = DB::table('modalidade')->get();
      return view('modalidade.modalidade',['modalidade'=>$modalidade]);
    }

    public function create()
    {
      $modalidade = DB::table('modalidade')->get();
      return view('modalidade.modalidade_frm',['modalidade'=>$modalidade]);
    }

    public function save(Request $request)
    {
      $n = DB::table('modalidade')->insertGetId(
        ['nome' => $request->nome, ]
      );       

      return redirect('/modalidade/')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {      
      $modalidade = DB::table('modalidade')->where('id', $id)->first();      

      return view('modalidade.modalidade_frm',['modalidade'=>$modalidade]);      
    }

    public function update(Request $request, $id)
    {
      DB::table('modalidade') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('/modalidade/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');      
    }


    public function delete($id){
      DB::table('modalidade')->where('id', $id)->delete();
      
      return redirect('/modalidade');
    }

}
