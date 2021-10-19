<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstrategiaController extends Controller
{
    public function save( Request $request )
    {
      //dd( $request->all() );

      if ( $request->id > 0 ){
        
        DB::table('estrategia') ->where('id', $request->id)
        ->update([
           'nome' => $request->nome,
        ]);

        return 'editado';

      }else if( $request->id == 0 ){

        $n = DB::table('estrategia')->insert([
           'obj_id' => $request->obj_id,
           'nome' => $request->nome,
           'ativo' => 1,           
        ]);

        return 'inserido';
      }

      
    }

}
