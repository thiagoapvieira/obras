<?php

namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $orgao_id = 3;
        $ano = 2019;

        $nota = DB::table('nota')->where('orgao_id',$orgao_id)->where('ano',$ano)->first();
        // if($nota == null){ $nota = 0; }

        $sql  = " select o.id, o.nome, im.ano  from indicador_responsavel ir ";
        $sql .= " join indicador_meta im on im.indicador_id = ir.indicador_id ";
        $sql .= " join indicador i on i.id = ir.indicador_id ";
        $sql .= " join estrategia e on e.id = i.est_id ";
        $sql .= " join objetivo o on o.id = e.obj_id ";
        $sql .= " where ir.orgao_id = ".$orgao_id." and im.ano = " . $ano;
        $sql .= " group by o.id, o.nome, im.ano ";
        $indicador = DB::select($sql);

        //dd($indicador);

        return view('planejamento.relatorio.relatorio_orgao', compact('nota','indicador'));
    }

}



