<?php

if (! function_exists('getIndicadorSituacao')) {
    function getIndicadorSituacao() {
        return DB::table('indicador_situacao')->get();
    }
}

if (! function_exists('getIndicadorMeta')){
    function getIndicadorMeta($indicador_id, $tipo, $ano){
        $f = DB::table('indicador_meta')
        ->where('indicador_id', $indicador_id)
        ->where('tipo', $tipo)
        ->where('ano', $ano)
        ->value('valor');

        return $f;
    }
}

if (! function_exists('getObjetivo')) {
    function getObjetivo($per_id) {
        return DB::table('objetivo')->where('per_id', $per_id)->where('ativo', 1)->get();
    }
}

if (! function_exists('getEstrategia')) {
    function getEstrategia($obj_id) {
        return DB::table('estrategia')->where('obj_id', $obj_id)->where('ativo', 1)->get();
    }
}


if (! function_exists('getIndicador')) {
    function getIndicador($est_id) {
        return DB::table('indicador')->where('est_id', $est_id)->where('ativo', 1)->get();
    }
}


if (! function_exists('usuario_nome')) {
    function usuario_nome($id) {
        $nome = DB::table('usuario')->where('id', $id)->value('nome');
        return $nome;
    }
}

if (! function_exists('usuario_status')) {
    function usuario_status($status) {
        switch ($status) {
            case 0: $status = 'Bloqueado';  break;
            case 1: $status = 'Ativo';  break;
        }
        return $status;
    }
}


if (! function_exists('status_fases')) {
    function status_fases($status_fases)
    {
        switch ($status_fases) {
            case 0: $status_fases = 'Em planejamento'; break;
            case 1: $status_fases = 'Em licitação'; break;
            case 2: $status_fases = 'A iniciar'; break;
            case 3: $status_fases = 'Em execução'; break;
            case 4: $status_fases = 'Paralisado'; break;
            case 5: $status_fases = 'Concluído'; break;
            case 6: $status_fases = 'Cancelada'; break;
        }
        return $status_fases;
    }
}


if (! function_exists('obra_status')) {
    function obra_status($status)
    {
        switch ($status) {
            case -1: $status = 'Excluído';  break;
            case 0: $status = 'Pendente de publicação';  break;
            case 1: $status = 'Em andamento';  break;
            case 2: $status = 'Paralisado';  break;
            case 3: $status = 'Finalizado';  break;
            case 4: $status = 'Entregue';  break;
        }
        return $status;
    }
}


if (! function_exists('statusCronograma')) {
    function statusCronograma($status)
    {
        switch ($status) {
            case 0: $status = 'A iniciar';  break;
            case 1: $status = 'Em andamento';  break;
            case 2: $status = 'Atrasado';  break;
            case 3: $status = 'Concluído';  break;
        }
        return $status;
    }
}



if (! function_exists('dateBR')) {

    function dateBR($date)
    {
        if($date == '' or $date == null){
            return '';
        }

        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        return $date->format('d/m/Y H:i:s');
    }
}



if (! function_exists('dateBR2')) {

    function dateBR2($date)
    {
        if($date == '' or $date == null){
            return '';
        }

        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        return $date->format('d/m/Y');
    }
}



if (! function_exists('status')) {
    function status($status)
    {
        switch ($status) {
            case 0: $status = 'Ruim'; break;
            case 1: $status = 'Regular'; break;
            case 2: $status = 'Bom'; break;
            case 3: $status = 'Não informado'; break;
        }
        return $status;
    }
}



if (! function_exists('caixa_cinza')) {
    function caixa_cinza($caixa_cinza)
    {
        switch ($caixa_cinza) {
            case 0: $caixa_cinza = 'Não'; break;
            case 1: $caixa_cinza = 'Sim'; break;
            case 2: $caixa_cinza = 'Não informado'; break;
            case 3: $caixa_cinza = 'Não aplicável'; break;
        }
        return $caixa_cinza;
    }
}


// if (! function_exists('investido')) {
//     function investido($id)
//     {
//         $sql  = " select  sum(investido) as investido from ";
//         $sql .= " (select O.id, O.percentual_execucao_financeira as perc, ";
//         $sql .= " (sum(V.valor)) as investido ";
//         $sql .= " from obra O ";
//         $sql .= " inner join obra_valor V on V.obra_id = O.id ";
//         $sql .= " where O.setor_id = ".$id;
//         $sql .= " group by O.id, O.percentual_execucao_financeira ";
//         $sql .= " ) as tebela ";

//         return $a = DB::select($sql)[0]->investido;

//         // dd($a);
//     }
// }


// if (! function_exists('executado')) {
//     function executado($id)
//     {
//         $sql  = " select  sum(executado) as executado from ";
//         $sql .= " (select O.id, O.percentual_execucao_financeira as perc, ";
//         $sql .= " round( ((sum(V.valor)) * O.percentual_execucao_financeira)/100 ,2 ) as executado  ";
//         $sql .= " from obra O ";
//         $sql .= " inner join obra_valor V on V.obra_id = O.id ";
//         $sql .= " where O.setor_id = ".$id;
//         $sql .= " group by O.id, O.percentual_execucao_financeira ";
//         $sql .= " ) as tebela ";

//         return $a = DB::select($sql)[0]->executado;
//     }
// }



if (! function_exists('setor')) {
    function setor($n){
        return DB::table('setor')->where('id',$n)->value('nome');
    }
}

if (! function_exists('modalidade')) {
    function modalidade($n){
        return DB::table('modalidade')->where('id',$n)->value('nome');
    }
}

if (! function_exists('tipologia')) {
    function tipologia($n){
        return DB::table('tipologia')->where('id',$n)->value('nome');
    }
}

if (! function_exists('fase_licitacao')) {
    function fase_licitacao($n){
        return DB::table('fase_licitacao')->where('id',$n)->value('nome');
    }
}

if (! function_exists('projeto')) {
  function projeto($n){
      return DB::table('projeto')->where('id',$n)->value('nome');
  }
}

if (! function_exists('sim_nao')) {
    function sim_nao($n){

        if($n == 0){
            return 'Não';
        }elseif($n == 1){
            return 'Sim';
        }

    }
}


if (! function_exists('log_hitorico')) {
    function log_hitorico($request, $id)
    {
        //verifique se teve alteração
        $obra_aux = DB::table('obra')->where('id', $id)->first();

        $texto = '';
        $atualizar = 0;

        $usuario_id = session()->get('userLogado')['id'];
        $usuario_nome = session()->get('userLogado')['nome'];

        $texto .= "<div><b>(".$obra_aux->id.") ".$obra_aux->descricao."</b></div>";
        $texto .= "<div> <i>".$usuario_nome."</i> alterou registros. </div>";
        $texto .= "<br>";

        $t = 'descricao';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$t . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$t . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'prioritaria';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Data de atualização';
        if(dateBr($obra_aux->dt_atualizacao) != $request->dt_atualizacao){
          if(dateBr($obra_aux->dt_atualizacao) != $request->dt_atualizacao.' 00:00:00'){
            $texto .= "<div><b>".$t.":</b></div>";
            $texto .= "<div style='color:#990000;'> ( - ) " . dateBR($obra_aux->dt_atualizacao) . "</div>";
            $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->dt_atualizacao . "</div>";
            $texto .= "<br>";
            $atualizar=1;
          }
        }

        $t = 'IGESP';
        if($obra_aux->igesp != $request->igesp){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->igesp . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->igesp . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Setor';
        $table = 'setor_id';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . setor($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . setor($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Modalidade';
        $table = 'modalidade_id';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . modalidade($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . modalidade($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Tipologia';
        $table = 'tipologia_id';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - )  " . tipologia($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . tipologia($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }


        $t = 'Percentual de execução financeira';
        $table = 'percentual_execucao_financeira';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - )  " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }














        $t = 'Status fases';
        $table = 'status_fases';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - )  " . status_fases($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . status_fases($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Fase da licitação';
        $table = 'fase_licitacao';
        if($obra_aux->fase_licitacao_id != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - )  " . fase_licitacao($obra_aux->fase_licitacao_id) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . fase_licitacao($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'desapropriacao';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }


        $t = 'licenca_ambiental_previa';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'licenca_ambiental_instalacao';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'projeto_basico';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'projeto_executivo';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'titularidade';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'licenca_outros_orgaos';
        if($obra_aux->$t != $request->$t){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . sim_nao($obra_aux->$t) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . sim_nao($request->$t) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Especifique orgaos';
        $table = 'especifique_orgaos';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - )  " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Data de início';
        $table = 'dt_inicio';
        if(dateBr($obra_aux->$table) != $request->$table.' 00:00:00'){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . dateBR($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Data de conclusão prevista';
        $table = 'dt_conclusao_prevista';
        if(dateBr($obra_aux->$table) != $request->$table){
          if(dateBr($obra_aux->$table) != $request->$table.' 00:00:00'){
            $texto .= "<div><b>".$t.":</b></div>";
            $texto .= "<div style='color:#990000;'> ( - ) " . dateBR($obra_aux->$table) . "</div>";
            $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
            $texto .= "<br>";
            $atualizar=1;
          }
        }

        $t = 'Data de conclusão realizada';
        $table = 'dt_conclusao_realizada';
        if(dateBr($obra_aux->$table) != $request->$table){
          if(dateBr($obra_aux->$table) != $request->$table.' 00:00:00'){
            $texto .= "<div><b>".$t.":</b></div>";
            $texto .= "<div style='color:#990000;'> ( - ) " . dateBR($obra_aux->$table) . "</div>";
            $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
            $texto .= "<br>";
            $atualizar=1;
          }
        }

        $t = 'Prazo de entrega';
        $table = 'prazo_entrega';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Percentual de execução física (%)';
        $table = 'percentual_execucao_fisica';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Data de assinatura do contrato';
        $table = 'dt_assinatura_contrato';
        if(dateBr($obra_aux->$table) != $request->$table.' 00:00:00'){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . dateBR($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Observações';
        $table = 'obs';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Detalhar o estágio atual da obra';
        $table = 'descricao_estagio';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Descrever próxima fase da obra';
        $table = 'descricao_proxima_fase';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Descrever as pendências (se houver) e o prazo estimado para a obra ir para a próxima fase.';
        $table = 'descricao_pendencias_prazo';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . $obra_aux->$table . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . $request->$table . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }

        $t = 'Status';
        $table = 'status';
        if($obra_aux->$table != $request->$table){
          $texto .= "<div><b>".$t.":</b></div>";
          $texto .= "<div style='color:#990000;'> ( - ) " . status($obra_aux->$table) . "</div>";
          $texto .= "<div style='color:#2d862d;'> ( + ) " . status($request->$table) . "</div>";
          $texto .= "<br>";
          $atualizar=1;
        }


        if($atualizar == 1){
          //log historico
          $n = DB::table('obra_historico')->insert(
            ['acao' => 'edição',
             'obra_id' => $id,
             'usuario_id' => $usuario_id,
             'texto' => $texto,
            ]
          );
        }


        // echo $texto;

    }
}








