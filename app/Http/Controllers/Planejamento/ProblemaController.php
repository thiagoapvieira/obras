<?php
namespace App\Http\Controllers\Planejamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemaController extends Controller
{
    public function all(Request $request)
    {
        $problema = DB::table('problema')->get();

        return response()->json($problema);
    }

    public function index()
    {
      $problema = DB::table('problema')->get();
      return view('planejamento.problema.problema',['problema'=>$problema]);
    }

    public function create()
    {
      $problema = DB::table('problema')->get();
      return view('planejamento.problema.problema_frm',['problema'=>$problema]);
    }

    public function save(Request $request)
    {
      $n = DB::table('problema')->insertGetId(
        ['nome' => $request->nome, ]
      );

      return redirect('planejamento/problema')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
      $problema = DB::table('problema')->where('id', $id)->first();

      return view('planejamento.problema.problema_frm',['problema'=>$problema]);
    }

    public function update(Request $request, $id)
    {
      DB::table('problema') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('planejamento/problema/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');
    }

    public function delete($id){
      DB::table('problema')->where('id', $id)->delete();

      return redirect('planejamento/problema');
    }
}



