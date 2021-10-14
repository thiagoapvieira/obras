<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ProjetoController extends Controller
{
    public function index()
    {
      $projeto = DB::table('projeto')->get();
      return view('obras.projeto.projeto',['projeto'=>$projeto]);
    }

    public function create()
    {
      $projeto = DB::table('projeto')->get();
      return view('obras.projeto.projeto_frm',['projeto'=>$projeto]);
    }

    public function save(Request $request)
    {
      $n = DB::table('projeto')->insertGetId(
        ['nome' => $request->nome, ]
      );       

      return redirect('obras/projeto/')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {      
      $projeto = DB::table('projeto')->where('id', $id)->first();      

      return view('obras.projeto.projeto_frm',['projeto'=>$projeto]);      
    }

    public function update(Request $request, $id)
    {
      DB::table('projeto') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('obras/projeto/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');      
    }


    public function delete($id){
      DB::table('projeto')->where('id', $id)->delete();
      
      return redirect('obras/projeto');
    }

}
