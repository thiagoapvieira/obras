<?php
namespace App\Http\Controllers\Planejamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SituacaoController extends Controller
{
    public function all(Request $request)
    {
        $situacao = DB::table('indicador_situacao')->get();

        return response()->json($situacao);
    }

    public function index()
    {
      $situacao = DB::table('indicador_situacao')->get();
      return view('planejamento.situacao.situacao',['situacao'=>$situacao]);
    }

    public function create()
    {
      $situacao = DB::table('indicador_situacao')->get();
      return view('planejamento.situacao.situacao_frm',['situacao'=>$situacao]);
    }

    public function save(Request $request)
    {
      $n = DB::table('indicador_situacao')->insertGetId(
        ['nome' => $request->nome, ]
      );

      return redirect('planejamento/situacao')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
      $situacao = DB::table('indicador_situacao')->where('id', $id)->first();

      return view('planejamento.situacao.situacao_frm',['situacao'=>$situacao]);
    }

    public function update(Request $request, $id)
    {
      DB::table('indicador_situacao') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('planejamento/situacao/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');
    }


    public function delete($id){
      DB::table('indicador_situacao')->where('id', $id)->delete();

      return redirect('planejamento/situacao');
    }


}



