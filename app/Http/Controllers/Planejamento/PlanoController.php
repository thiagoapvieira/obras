<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanoController extends Controller
{
    public function index()
    {
      $plano = DB::table('plano')->where('ativo',1)->get();

      return view('planejamento.plano.plano',['plano'=>$plano]);
    }

    public function create()
    {
      $plano = DB::table('plano')->get();
      return view('planejamento.plano.plano_frm',['plano'=>$plano]);
    }

    public function save(Request $request)
    {
      $n = DB::table('plano')->insertGetId([
        'nome' => $request->nome,
        'visao' => $request->visao,
        'missao' => $request->missao,
        'valores' => $request->valores,
      ]);

      return redirect('planejamento/plano')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
      $plano = DB::table('plano')->where('id', $id)->first();

      return view('planejamento.plano.plano_frm',['plano'=>$plano, ]);
    }

    public function update(Request $request, $id)
    {
      DB::table('plano') ->where('id', $id)
      ->update([
        'nome' => $request->nome,
        'visao' => $request->visao,
        'missao' => $request->missao,
        'valores' => $request->valores,
      ]);

      return redirect('planejamento/plano/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');
    }

    public function delete($id)
    {
      DB::table('plano')->where('id', $id)->delete();

      return redirect('planejamento/plano');
    }
}
