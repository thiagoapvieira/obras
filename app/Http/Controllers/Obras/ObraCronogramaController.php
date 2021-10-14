<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ObraCronogramaController extends Controller
{
    
    // public function filterLimpar(){
    //   $filtro = [
    //      "atividade" => null,         
    //      // "dt_inicio" => null,
    //      // "dt_termino" => null,
    //   ];  

    //   session(['obra_cronograma_filtro' => $filtro]);
    //   return redirect('obras/obra/142/cronograma');
    // }

    public function filter(Request $request){
      $filtro = [
         "atividade" => $request->atividade,
         // "dt_inicio" => $request->dt_inicio,
         // "dt_termino" => $request->dt_termino,       
      ]; 

      session(['obra_cronograma_filtro' => $filtro]);
      return redirect('obras/obra/'.$request->obra_id.'/cronograma');
    }

    public function liste($obra_id)
    {
        $filtro = session()->get('obra_cronograma_filtro');
        
        $obra = DB::table('obra')->where('id', $obra_id)->first();        

        $query = DB::table('obra_cronograma')->where('obra_id', $obra_id)->orderBy('index');

        if( isset($filtro['atividade'])) {
          if($filtro['atividade'] <> null and $filtro['atividade'] <> null){        
              $query->where('atividade', 'like', '%'.$filtro['atividade'].'%');       
          }
        }       

        $cronograma = $query->get();
        
        return view('obras.obra.obra_cronograma',[
          'id'=>$obra->id, 
          'obra'=>$obra, 
          'cronograma'=>$cronograma, 
          'filtro' => $filtro,
        ]); 
    }


    public function create($obra_id){
        return view('obras.obra.obra_cronograma_frm',['obra_id'=>$obra_id, 'id'=>0,]);
    }

    public function save(Request $request, $obra_id)
    {
        if($request->dt_inicio <> '' or $request->dt_inicio <> null){
            $arrayData = explode("/",$request->dt_inicio);
            $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
            $dt_inicio = date_format($date,"Y-m-d H:i:s");
        }else{
          $dt_inicio = null;
        }    

        if($request->dt_termino <> '' or $request->dt_termino <> null){
          $arrayData = explode("/",$request->dt_termino);
          $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
          $dt_termino = date_format($date,"Y-m-d H:i:s");
        }else{
          $dt_termino = null;
        }
        
        $n = DB::table('obra_cronograma')->insertGetId(
          [
           'obra_id' => $obra_id,
           'pos' => $request->pos,
           'atividade' => $request->atividade,
           'responsavel' => $request->responsavel,           
           'dt_inicio' => $dt_inicio,
           'dt_termino' => $dt_termino,
           'prazo' => $request->prazo,
           'status_id' => $request->status_id,
          ]
        );       

        return redirect('obras/obra/'.$obra_id.'/cronograma/'.$n.'/editar')->with('msg', 'Registro salvo com sucesso!'); 
      }


    public function editar($obra_id, $id){  
        $obra_cronograma = DB::table('obra_cronograma')->where('id', $id)->first();    
        return view('obras.obra.obra_cronograma_frm',['obra_id'=>$obra_id, 'id'=>$id, 'obra_cronograma'=>$obra_cronograma]);
    }

    public function update(Request $request, $obra_id, $id){
        
        if($request->dt_inicio <> '' or $request->dt_inicio <> null){
            /*ajuste o formato data e hora*/
            $arrayData = explode("/",$request->dt_inicio);
            $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
            $dt_inicio = date_format($date,"Y-m-d H:i:s");
        }else{
          $dt_inicio = null;
        }

        if($request->dt_termino <> '' or $request->dt_termino <> null){
          /*ajuste o formato data e hora*/
          $arrayData = explode("/",$request->dt_termino);
          $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
          $dt_termino = date_format($date,"Y-m-d H:i:s");
        }else{
          $dt_termino = null;
        }

        DB::table('obra_cronograma') ->where('id', $id)
        ->update(
          [
           'pos' => $request->pos,
           'atividade' => $request->atividade,
           'responsavel' => $request->responsavel,           
           'dt_inicio' => $dt_inicio,
           'dt_termino' => $dt_termino,
           'prazo' => $request->prazo,
           'status_id' => $request->status_id,
          ]
        );

        return redirect('obras/obra/'.$obra_id.'/cronograma/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');       
    }


    public function delete($obra_id, $id){
      DB::table('obra_cronograma')->where('id', $id)->delete();
      return redirect('obras/obra/'.$obra_id.'/cronograma');
    }





    
    

}