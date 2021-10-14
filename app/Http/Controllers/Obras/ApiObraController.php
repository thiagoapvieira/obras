<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class ApiObraController extends Controller
{
    public function getObra()
    {
      return DB::table('obra_view')->get();
    }


    public function filterOrgao(Request $request)
    {
	  	$sql  = " select * from orgao ";
  		$sql .= " where sigla like '%".$request->name."%' ";
  		$sql .= " or nome like '%".$request->name."%' ";
  		$sql .= " order by sigla, nome ";
  		
  		return DB::select($sql);
	  }


    public function getObraOrgaoRelacionados($obra_id)
    {      
      return DB::table('obra_orgao_view')->where('obra_id',$obra_id)->get();
    }


    public function getObraOrgaoRelacionar($obra_id, $orgao_id)
    {      
      DB::table('obra_orgao_view')->insert([
      	'obra_id'=>$obra_id,
      	'orgao_id'=>$orgao_id,
      ]);      

      return 'ok';
    }


    public function ObraOrgaoexcluir($id)
    {
      return DB::table('obra_orgao')->where('id', $id)->delete();
    }


    public function ObraOrgaoPrincipal(Request $request,$id)
    {
      DB::table('obra_orgao')->where('obra_id', $request->obra_id)
      ->update(['principal' => 0]);

      echo DB::table('obra_orgao')->where('id', $id)
      ->update(['principal' => 1]);

      // if($a == 1){

      //   return'ok';
      // }  


    }



    /*
      cidade
    */  

    public function getObraCidadeRelacionados($obra_id)
    {      
      return DB::table('obra_cidade_view')->where('obra_id',$obra_id)->get();
    }


    public function getObraCidadeRelacionar($obra_id, $cidade_id)
    {      
      DB::table('obra_cidade')->insert([
        'obra_id'=>$obra_id,
        'cidade_id'=>$cidade_id,
      ]);      

      return 'ok';
    }

    public function ObraCidadeExcluir($id)
    {
      return DB::table('obra_cidade')->where('id', $id)->delete();
    }

    public function filterCidade(Request $request)
    {
      $sql  = " select * from cidade_view ";
      $sql .= " where nome like '%".$request->name."%' ";      
      $sql .= " order by nome ";
      
      return DB::select($sql);
    }



    /*
      Adicionar valor das obras
    */
    public function lista($obra_id)
    {      
      return DB::table('obra_valor')->where('obra_id', $obra_id)->get();
    }

    public function find_valor($obra_id,$valor_id)
    {      
      return DB::table('obra_valor')->where('id', $valor_id)->get();

    }

    public function valor_novo(Request $request)
    {      
      DB::table('obra_valor')->insert([
        'obra_id'=>$request->obra_id,
        'fonte'=>$request->fonte,
        'valor'=>$request->valor,
      ]);
    }

    public function valor_update(Request $request,$obra_id,$id)
    {

      //verifique se teve alteração
      $obra_aux = DB::table('obra')->where('id', $obra_id)->first();
      $obra_valor_aux = DB::table('obra_valor')->where('id', $id)->first();

      $texto = '';
      $atualizar = 0;

      $usuario = DB::table('usuario')->where('id', $request->usuario_id)->first();

      
      $t = 'Fonte de recurso';
      if( ($obra_valor_aux->fonte != $request->fonte) or ($obra_valor_aux->valor != $request->valor) ){

        $texto .= "<div><b>(".$obra_aux->id.") ".$obra_aux->descricao."</b></div>";
        $texto .= "<div> <i>".$usuario->nome."</i> alterou registros. </div>";
        $texto .= "<br>";
        
        $texto .= "<div><b>".$t.":</b></div>";
        $texto .= "<div style='color:#990000;'> ( - ) " .$obra_valor_aux->fonte." ". $obra_valor_aux->valor ."</div>";
        $texto .= "<div style='color:#2d862d;'> ( + ) " .$request->fonte." ". $request->valor ."</div>";
        $texto .= "<br>";
        $atualizar=1;
        
      }

      if($atualizar == 1){
        //log historico
        $n = DB::table('obra_historico')->insert(
          ['acao' => 'edição',
           'obra_id' => $obra_id,
           'usuario_id' => 1,         
           'texto' => $texto,
          ]
        );
      }


      return DB::table('obra_valor')->where('id', $id)
      ->update([
          'obra_id'=>$request->obra_id,
          'fonte'=>$request->fonte,
          'valor'=>$request->valor,
      ]);  
    

    }

    public function valor_delete($obra_id,$id){
      return DB::table('obra_valor')->where('id',$id)->delete();
    }




    

}
