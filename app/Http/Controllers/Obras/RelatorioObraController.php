<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class RelatorioObraController extends Controller
{
    
  public function filterLimpar(){
    $filtro = [
       "descricao" => null,
       "regiao_id" => null,
       "cidade_id" => null,
       "tipologia_id" => null,
       "status_id" => null,
       "dt_inicio" => null,
       "dt_conclusao_realizada" => null,
    ];  

    session(['obra_filtro' => $filtro]);    

    return redirect('obra2');
  }

  public function filter(Request $request){
    $filtro = [
       "descricao" => $request->descricao,
       "regiao_id" => $request->regiao_id,
       "cidade_id" => $request->cidade_id,
       "tipologia_id" => $request->tipologia_id,
       "status_id" => $request->status_id,
       "dt_inicio" => $request->dt_inicio,
       "dt_conclusao_realizada" => $request->dt_conclusao_realizada,       
    ];  

    session(['obra_filtro' => $filtro]); 
    
    //modulo pdf - se apertou o botao imprimir
    if( $request->pdf > 0 ){
        session_start();
        $_SESSION["obra_filtro"] = $filtro;

        return redirect( getenv('APP_URL').'pdf/examples/lista.php');         
    }  

    return redirect('obra2');
  }


  public function obra(){

    $filtro = session()->get('obra_filtro');

    $cidade = DB::table('cidade')->get();   
    $regiao = DB::table('regiao')->get();   
    $tipologia = DB::table('tipologia')->get();   

    // $obras = DB::table('obra_view')->where('descricao', 'like', '%'.$filtro['descricao'].'%')->get();

    //filtro cidades
    $c = '';
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){ 
        $c = 'and cidade_id = '.$filtro['cidade_id'];
      }
    }

    $query = DB::table('obra');

    $query->select( 
      'obra.id',
      'obra.tipologia_id',
      'obra.descricao',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.dt_inicio',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual',
      'obra.status',
      'obra.created_at',
      'obra.updated_at',
      'obra.obs',
      'obra.paralisacao',
      'obra.percentual_execucao_financeira',
      'obra.status_fases',
      'tipologia.nome as tipologia_nome',
      
      (DB::raw("(select sum(valor) from obra_valor where obra_id = obra.id) as valor_total"))     


    );

    $query->leftJoin('tipologia', 'obra.tipologia_id', '=', 'tipologia.id'); 
    $query->leftJoin('obra_cidade', 'obra_cidade.obra_id', '=', 'obra.id'); 
    $query->leftJoin('cidade', 'cidade.id', '=', 'obra_cidade.cidade_id');  
    $query->leftJoin('regiao', 'regiao.id', '=', 'cidade.regiao_id'); 

    if( isset($filtro['descricao'])) {
      if($filtro['descricao'] <> null and $filtro['descricao'] <> null){        
          $query->where('descricao', 'like', '%'.$filtro['descricao'].'%');       
      }
    }

    //regiao    
    if( isset($filtro['regiao_id'])) {
      if($filtro['regiao_id'] > 0){
        $query->where('regiao.id',$filtro['regiao_id']);
      }
    }

    //cidade
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){
        $query->where('cidade.id',$filtro['cidade_id']);
      }
    }

    //tipologia
    if( isset($filtro['tipologia_id'])) {
      if($filtro['tipologia_id'] > 0){
        $query->where('tipologia.id',$filtro['tipologia_id']);
      }
    }

    //status
    if( isset($filtro['status_id'])) {
      if($filtro['status_id'] > 0){
        $query->where('obra.status',$filtro['status_id']);
      }
    }

   
    /*ajuste o formato data e hora*/
    if( isset($filtro['dt_inicio']) and $filtro['dt_inicio'] <> null){
      $arrayData = explode("/",$filtro['dt_inicio']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_inicio = date_format($date,"Y-m-d");
    }

    if( isset($filtro['dt_conclusao_realizada']) and ($filtro['dt_conclusao_realizada'] <> null or $filtro['dt_conclusao_realizada'] <> '') ){
      $arrayData = explode("/",$filtro['dt_conclusao_realizada']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_fim = date_format($date,"Y-m-d");
    }

    // dd($data_fim);


    //periodo
    if( isset($filtro['dt_inicio']) and isset($filtro['dt_conclusao_realizada']) ) {
      if($filtro['dt_inicio'] != '' and $filtro['dt_conclusao_realizada'] != ''){
        $query->whereBetween('obra.dt_inicio', [$data_inicio, $data_fim]);
      }
    }


    $query->groupBy(
      'obra.id',
      'obra.tipologia_id',
      'obra.descricao',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.dt_inicio',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual',
      'obra.status',
      'obra.created_at',
      'obra.updated_at',
      'obra.obs',
      'obra.paralisacao',
      'tipologia.nome' 
      );

      $query->orderBy('obra.id','desc');

      $obras = $query->paginate(10);

      // dd($obras);

      //estatisticas
      $em_andamento = DB::table('obra')->where('status', '=', 1)->count();
      $paralisado = DB::table('obra')->where('status', '=', 2)->count();
      $finalizado = DB::table('obra')->where('status', '=', 3)->count();
      $entregue = DB::table('obra')->where('status', '=', 4)->count();
      $total = $em_andamento + $paralisado + $finalizado + $entregue;

      return view('relatorio.relatorio_obra',[
        'obra'=>$obras,
        'filtro' => $filtro,
        'cidade' => $cidade,
        'regiao' => $regiao,
        'tipologia'=>$tipologia,
        'em_andamento'=>$em_andamento,
        'paralisado'=>$paralisado,
        'finalizado'=>$finalizado,
        'entregue'=>$entregue,
        'total'=>$total,
      ])->with('items', $obras);

  }

    
  public function view($id)
  {
    $obra = DB::table('obra')->where('id', $id)->first();

    return view('relatorio.relatorio_obra_single',[
      'id'=>$id,
      'obra'=>$obra, 
    ]);
  }



}
