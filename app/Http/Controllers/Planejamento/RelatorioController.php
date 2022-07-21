<?php

namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index($orgao_id, $ano)
    {
        // $orgao_id = 52;
        // $ano = 2019;

        $orgao = DB::table('orgao')->where('id',$orgao_id)->first();

        $nota = DB::table('nota')->where('orgao_id',$orgao_id)->where('ano',$ano)->first();
        // if($nota == null){ $nota = 0; }


        $sql  = " select ";
        $sql .= " o.id, o.nome, im.ano ";
        $sql .= " ,( ";

        $sql .= " select sum(valor)/ sum(soma_peso) as realizado from ";
        $sql .= " ( ";
        $sql .= " select i.id, im.valor, i.soma_peso ";
        $sql .= " FROM indicador_meta im ";
        $sql .= " inner join indicador i on i.id = im.indicador_id ";
        $sql .= " inner join estrategia e on e.id = i.est_id ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id = i.id ";
        $sql .= " where e.obj_id = o.id and ano = ".$ano." and tipo = 'ponderada' ";
        $sql .= " group by i.id, im.valor, i.soma_peso ";
        $sql .= " )as tabela_aux ";

        $sql .= " ) as realizado ";
        $sql .= " from indicador_responsavel ir ";
        $sql .= " join indicador_meta im on im.indicador_id = ir.indicador_id ";
        $sql .= " join indicador i on i.id = ir.indicador_id ";
        $sql .= " join estrategia e on e.id = i.est_id ";
        $sql .= " join objetivo o on o.id = e.obj_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and im.ano = ".$ano;
        $sql .= " group by o.id, o.nome, im.ano; ";
        $indicador = DB::select($sql);



        //Qtd Indicadores
        $sql  = " select count(indicador_id) as qtd from ( ";
        $sql .= " select ir.indicador_id ";
        $sql .= " FROM indicador_responsavel ir ";
        $sql .= " inner join indicador_meta im on im.indicador_id = ir.indicador_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and im.ano = ".$ano;
        $sql .= " group by ir.indicador_id ";
        $sql .= " ) as tabela ";
        $qtd_indicadores_ano = DB::select($sql)[0]->qtd;


        /* SITUAÇÃO
            '1', 'Cumprimento total'
            '2', 'Cumpriemento parcial'
            '3', 'Não cumprimento'
        */


        //QTD CUMPRIMENTO TOTAL
        $sql  = " select count(1) as qtd ";
        $sql .= " from indicador_meta im ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id = im.indicador_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id;
        $sql .= " and im.tipo = 'situacao' ";
        $sql .= " and im.ano = ".$ano;
        $sql .= " and im.valor = 1 ";
        $qtd_cumprimento_total = DB::select($sql)[0]->qtd;

        //QTD CUMPRIMENTO PARCIAL TOTAL
        $sql  = " select count(1) as qtd ";
        $sql .= " from indicador_meta im ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id = im.indicador_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id;
        $sql .= " and im.tipo = 'situacao' ";
        $sql .= " and im.ano = ".$ano;
        $sql .= " and im.valor = 2 ";
        $qtd_cumprimento_parcial = DB::select($sql)[0]->qtd;

        //QTD NAO CUMPRIMENTO TOTAL
        $sql  = " select count(1) as qtd ";
        $sql .= " from indicador_meta im ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id = im.indicador_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id;
        $sql .= " and im.tipo = 'situacao' ";
        $sql .= " and im.ano = ".$ano;
        $sql .= " and im.valor = 3 ";
        $qtd_nao_cumprimento = DB::select($sql)[0]->qtd;

        //PRINCIPAIS PROBLEMAS
        $sql  = " select ";
        $sql .= " p.nome, count(1) as qtd ";
        $sql .= " from indicador_meta im ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id = im.indicador_id ";
        $sql .= " inner join problema p on p.id = im.valor ";
        $sql .= " where ir.orgao_id = ".$orgao_id;
        $sql .= " and im.tipo = 'problema' ";
        $sql .= " and im.ano = ".$ano;
        $sql .= " group by p.nome ";
        $principais_problemas = DB::select($sql);
        // dd($principais_problemas);




        //INDICADORES
        $perspectiva = DB::table('perspectiva')->where('plano_id', 3)->get();

        $array_per = array();
        foreach ($perspectiva as $value) {
            $obj = new \stdClass();
            $obj->id = $value->id;
            $obj->plano_id = $value->plano_id;
            $obj->nome = $value->nome;
            $obj->ativo = $value->ativo;

                $objetivo = DB::table('objetivo')->where('ativo',1)->where('per_id',$value->id)->get();
                $array_obj = array();
                foreach ($objetivo as $value) {
                    $obj2 = new \stdClass();
                    $obj2->id = $value->id;
                    $obj2->per_id = $value->per_id;
                    $obj2->nome = $value->nome;
                    $obj2->ativo = $value->ativo;

                        $estrategia = DB::table('estrategia')->where('ativo',1)->where('obj_id',$value->id)->get();
                        $array_est = array();
                        foreach ($estrategia as $value) {
                            $obj3 = new \stdClass();
                            $obj3->id = $value->id;
                            $obj3->nome = $value->nome;
                            array_push($array_est, $obj3);

                            $indicador_found = DB::table('indicador')->where('ativo',1)->where('est_id',$value->id)->get();
                            $array_ind = array();
                            foreach ($indicador_found as $value) {
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

                                $sql  = " select m.indicador_id, m.tipo, m.ano, m.ano, m.valor, s.nome as situacao_nome ";
                                $sql .= " from indicador_meta m ";
                                $sql .= " left join indicador_situacao s on (s.id = m.valor and m.tipo = 'situacao') ";
                                $sql .= " where ";
                                $sql .= " m.ativo = 1 ";
                                $sql .= " and m.indicador_id = ".$value->id;
                                $sql .= " and m.ano = ".$ano;
                                $sql .= " and (m.tipo = 'meta' or m.tipo = 'realizado' or m.tipo = 'situacao') ";
                                $meta_aux = DB::select($sql);

                                foreach ($meta_aux as $aux1) {
                                    if($aux1->tipo == 'meta'){ $obj4->meta_ano = $aux1->valor; }
                                    if($aux1->tipo == 'realizado'){ $obj4->realizado_ano = $aux1->valor; }
                                    if($aux1->tipo == 'situacao'){
                                        $obj4->situacao_id = $aux1->valor;  $obj4->situacao_ano = $aux1->situacao_nome;
                                    }
                                }

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

        // dd($array_per);

        return view('planejamento.relatorio.relatorio_orgao',
        compact('orgao',
                'ano',
                'nota',
                'indicador',
                'qtd_indicadores_ano',
                'qtd_cumprimento_total',
                'qtd_cumprimento_parcial',
                'qtd_nao_cumprimento',
                'principais_problemas',
                'array_per'
        ));
    }

}










