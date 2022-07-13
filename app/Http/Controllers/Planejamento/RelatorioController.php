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
        // dd($indicador);




        /*
        $sql  = " select o.id, o.nome, im.ano ";

        $sql .= " ,( ";
        $sql .= " select (im.valor/i.soma_peso) as realizado ";
        $sql .= " FROM indicador_meta im ";
        $sql .= " inner join indicador i on i.id  = im.indicador_id ";
        $sql .= " inner join estrategia e on e.id  = i.est_id ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id  = i.id ";
        $sql .= " where e.obj_id = 7 and ano = 2019 and tipo = 'ponderada' ";
        $sql .= " group by i.id, i.soma_peso, im.tipo, im.ano, im.valor, im.ativo, i.est_id, e.obj_id ";
        $sql .= " ) as realizado ";

        $sql .= " from indicador_responsavel ir ";
        $sql .= " join indicador_meta im on im.indicador_id = ir.indicador_id ";
        $sql .= " join indicador i on i.id = ir.indicador_id ";
        $sql .= " join estrategia e on e.id = i.est_id ";
        $sql .= " join objetivo o on o.id = e.obj_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and im.ano = " . $ano;
        echo $sql .= " group by o.id, o.nome, im.ano ";
        $indicador = DB::select($sql);
        dd($indicador);
        */

        /*
        $sql  = " select ";
        $sql .= " i.id, im.valor, i.soma_peso, (im.valor / i.soma_peso) as calculo ";
        $sql .= " FROM indicador_meta im ";
        $sql .= " inner join indicador i on i.id  = im.indicador_id ";
        $sql .= " where i.id = 2 and ano = ".$ano." and tipo = 'ponderada' ";
        $sql .= " order by id desc; ";
        $soma_peso = DB::select($sql)[0];
        // dd($soma_peso);
        */

        /*
        // soma de soma de peso
        $sql  = " select sum(soma) as soma_de_peso from ( ";
        $sql .= " select i.soma_peso as soma ";
        $sql .= " FROM indicador_meta im ";
        $sql .= " inner join indicador i on i.id  = im.indicador_id ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id  = i.id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and ano = ".$ano." ";
        $sql .= " group by i.id, i.soma_peso ";
        $sql .= " ) as tabela where soma is not null; ";
        $soma_peso = DB::select($sql)[0]->soma_de_peso;


        // soma de ponderada
        $sql  = " select sum(valor) as ponderada from ( ";
        $sql .= " select i.id, i.soma_peso, im.tipo, im.ano, im.valor, im.ativo, i.responsavel, ir.orgao_id as teste ";
        $sql .= " FROM indicador_meta im ";
        $sql .= " inner join indicador i on i.id  = im.indicador_id ";
        $sql .= " inner join indicador_responsavel ir on ir.indicador_id  = i.id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and ano = ".$ano." and tipo = 'ponderada' ";
        $sql .= " order by id desc ";
        $sql .= " ) as tabela where valor is not null ";
        $soma_ponderada = DB::select($sql)[0]->ponderada;
        //dd($soma_ponderada);
        */


        return view('planejamento.relatorio.relatorio_orgao', compact('orgao', 'ano', 'nota','indicador'));
    }

}










