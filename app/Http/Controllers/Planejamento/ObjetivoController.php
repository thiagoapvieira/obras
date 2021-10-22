<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjetivoController extends Controller
{
    public function save( Request $request )
    {

      //dd( $request->all() );

      if ( $request->id > 0 ){
        
        DB::table('objetivo') ->where('id', $request->id)
        ->update([
           'nome' => $request->nome,
        ]);

        return 'editado';

      }else if( $request->id == 0 ){

        $n = DB::table('objetivo')->insert([
           'per_id' => $request->per_id,
           'nome' => $request->nome,
           'ativo' => 1,           
        ]);

        return 'inserido';
      }

      
    }


    public function delete( $id ){
      DB::table('objetivo')->where('id',$id)->update(['ativo'=>0]);
    }

}
