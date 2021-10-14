<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class SetorController extends Controller
{
    public function index()
    {
      $setor = DB::table('setor')->get();
      return view('obras.setor.setor',['setor'=>$setor]);
    }

    public function create()
    {
      $setor = DB::table('setor')->get();
      return view('obras.setor.setor_frm',['setor'=>$setor]);
    }

    public function save(Request $request)
    {
      $n = DB::table('setor')->insertGetId(
        ['nome' => $request->nome, ]
      );       

      return redirect('obras/setor')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {      
      $setor = DB::table('setor')->where('id', $id)->first();      

      return view('obras.setor.setor_frm',['setor'=>$setor]);      
    }

    public function update(Request $request, $id)
    {
      DB::table('setor') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('obras/setor/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');      
    }


    public function delete($id){
      DB::table('setor')->where('id', $id)->delete();
      
      return redirect('obras/setor');
    }

}
