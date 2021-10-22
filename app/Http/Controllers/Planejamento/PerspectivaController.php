<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerspectivaController extends Controller
{
    public function index( $plano_id )
    {
      return view('planejamento.perspectiva.perspectiva', compact("plano_id"));
    }

    public function save(Request $request)
    {
      //edite
      if( $request->id > 0 ){

          DB::table('perspectiva') ->where('id', $request->id)->update([
              'nome' => $request->nome,
          ]);          

          return 'edicao';
      }
      
      //insert
      if( $request->id == 0 ){

          $n = DB::table('perspectiva') ->insertGetId([              
              'plano_id' => $request->plano_id,              
              'nome' => $request->nome,              
          ]);

          return 'insert';
      } 
    }

    public function delete( $id )
    {
      DB::table('perspectiva')->where('id',$id)->update(['ativo'=>0]);
    }


}
