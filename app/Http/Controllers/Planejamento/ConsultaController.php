<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    public function consulta (Request $request)
    {
        //dd($request->all());

        $campo = $request->nivel_pesq;

        $sql  = " select P.id, P.plano_id, P.nome, P.ativo ";
        $sql .= " from perspectiva P ";
        $sql .= " left join objetivo O on O.per_id = P.id ";
        $sql .= " left join estrategia E on E.obj_id = O.id ";
        $sql .= " left join indicador I on I.est_id = E.id ";
        $sql .= " where 1 = 1 ";
        $sql .= " and P.ativo = 1 ";
        $sql .= " and P.plano_id = ". $request->plano_id;

        //filtro da perspectiva
        if( isset($request->descricao) ){
            if($request->descricao <> null){
                if($campo == 'est'){
                    $sql .= " and E.nome like '%".$request->descricao."%' ";
                }
            }
            if($request->descricao <> null){
                if($campo == 'ind'){
                    $sql .= " and I.nome like '%".$request->descricao."%' ";
                }
            }
        }

        $sql .= " group by P.id, P.plano_id, P.nome, P.ativo ";

        $perspectiva = DB::select($sql);
        // dd($perspectiva);

        $array_per = array();
        foreach ($perspectiva as $value) {
            $obj = new \stdClass();
            $obj->id = $value->id;
            $obj->plano_id = $value->plano_id;
            $obj->nome = $value->nome;
            $obj->ativo = $value->ativo;

                $sql  = " select O.id, O.per_id, O.nome, O.ativo ";
                $sql .= " from objetivo O ";
                $sql .= " left join estrategia E on E.obj_id = O.id ";
                $sql .= " left join indicador I on I.est_id = E.id ";
                $sql .= " where 1 = 1 ";
                $sql .= " and O.ativo = 1 ";
                $sql .= " and O.per_id = ". $value->id;

                //filtro - indicador do objetivo
                if( isset($request->descricao) ){
                    if($request->descricao <> null){
                        if($campo == 'est'){
                            $sql .= " and E.nome like '%".$request->descricao."%' ";
                        }
                    }
                    if($request->descricao <> null){
                        if($campo == 'ind'){
                            $sql .= " and I.nome like '%".$request->descricao."%' ";
                        }
                    }
                }

                $sql .= " group by O.id, O.per_id, O.nome, O.ativo";

                // dd($sql);

                $objetivo = DB::select($sql);
                // dd($objetivo);

                $array_obj = array();
                foreach ($objetivo as $value) {
                    $obj2 = new \stdClass();
                    $obj2->id = $value->id;
                    $obj2->per_id = $value->per_id;
                    $obj2->nome = $value->nome;
                    $obj2->ativo = $value->ativo;

                        $sql  = " select E.id, E.nome ";
                        $sql .= " from estrategia E ";
                        // $sql .= " left join objetivo O on O.per_id = P.id ";
                        // $sql .= " left join estrategia E on E.obj_id = O.id ";
                        $sql .= " left join indicador I on I.est_id = E.id ";
                        $sql .= " where 1 = 1 ";
                        $sql .= " and E.ativo = 1 ";
                        $sql .= " and E.obj_id = ". $value->id;

                        //filtro - indicador da estrategia
                        if( isset($request->descricao) ){
                          if($request->descricao <> null and $campo == 'est'){
                            $sql .= " and E.nome like '%".$request->descricao."%' ";
                          }
                          if($request->descricao <> null and $campo == 'ind'){
                            $sql .= " and I.nome like '%".$request->descricao."%' ";
                          }
                        }

                        $sql .= " group by E.id, E.nome ";

                        $estrategia = DB::select($sql);

                        $array_est = array();
                        foreach ($estrategia as $value) {
                            $obj3 = new \stdClass();
                            $obj3->id = $value->id;
                            $obj3->nome = $value->nome;
                            array_push($array_est, $obj3);

                            $query = DB::table('indicador')->where('ativo',1);
                            $query->where('est_id',$value->id);

                            //filtro - indicador
                            if( isset($request->descricao) ){
                                if($request->descricao <> null and $campo == 'ind'){
                                  $query->where('nome','like','%'.$request->descricao.'%');
                                }
                            }

                            $indicador = $query->get();

                            $array_ind = array();
                            foreach ($indicador as $value) {
                                $obj4 = new \stdClass();
                                $obj4->id = $value->id;
                                $obj4->est_id = $value->est_id;
                                $obj4->nome = $value->nome;
                                $obj4->meta_agregada = $value->meta_agregada;
                                $obj4->realizado_acumulado = $value->realizado_acumulado;
                                $obj4->execucao_agregada = $value->execucao_agregada;
                                $obj4->status = $value->status;
                                $obj4->responsavel = $value->responsavel;
                                $obj4->ativo = $value->ativo;
                                array_push($array_ind, $obj4);
                            }
                            $obj3->indicador = $array_ind;

                        }
                        $obj2->estrategia = $array_est;


                    array_push($array_obj, $obj2);
                }

                $obj->objeto = $array_obj;

            array_push($array_per, $obj);
        }

        return response()->json($array_per);
    }

}
