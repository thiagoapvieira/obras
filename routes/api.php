<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Planejamento\ConsultaController;
use App\Http\Controllers\Planejamento\PerspectivaController;
use App\Http\Controllers\Planejamento\ObjetivoController;
use App\Http\Controllers\Planejamento\EstrategiaController;
use App\Http\Controllers\Planejamento\IndicadorController;
use App\Http\Controllers\Planejamento\OrgaoController;
use App\Http\Controllers\Planejamento\ProblemaController;
use App\Http\Controllers\Obras\ApiObraController;

Route::middleware(['cors'])->group(function(){

    //GERAL ------------------------------------------------------------------------------
    Route::post('regiao/{regiao_id}/cidade', function($regiao_id){
        if($regiao_id == 0){
            $regiao = DB::table('cidade')->get();
		}else{
            $regiao = DB::table('cidade')->where('regiao_id',$regiao_id)->get();
		}
		return $regiao;
	});


    //PLANEJAMENTO ------------------------------------------------------------------------------
    Route::prefix('planejamento')->group(function(){

        Route::get('get_plano', function (){
            $a = DB::table('plano')->get();
            return response()->json($a);
        });

        //consuta
        Route::post('consulta', [ConsultaController::class, 'consulta']);

        //perspectiva
        Route::get('perspectiva/delete/{id}', [PerspectivaController::class, 'delete']);
        Route::post('perspectiva/save', [PerspectivaController::class, 'save']);

        //objetivo
        Route::post('save_objetivo', [ObjetivoController::class, 'save']);
        Route::get('objetivo/delete/{id}', [ObjetivoController::class, 'delete']);

        //estrategia
        Route::post('save_estrategia', [EstrategiaController::class, 'save']);
        Route::get('estrategia/delete/{id}', [EstrategiaController::class, 'delete']);

        //indicador
        Route::get('indicador/find/{id}', [IndicadorController::class, 'find']);
        Route::post('indicador/save', [IndicadorController::class, 'save']);
        Route::post('indicador/inserir_novo_ano_meta_indicador', [IndicadorController::class, 'inserir_novo_ano_meta_indicador']);
        Route::post('indicador/delete_ano_meta_indicador', [IndicadorController::class, 'delete_ano_meta_indicador']);
        Route::post('indicador/incluir_responsavel', [IndicadorController::class, 'incluir_responsavel']);
        Route::get('indicador/{indicador_id}/responsavel/all', [IndicadorController::class, 'responsavel_all']);
        Route::get('indicador/{indicador_id}/delete', [IndicadorController::class, 'delete']);

        //orgao
        Route::post('orgao/find', [OrgaoController::class, 'find']);

        //problema
        Route::get('problema/all', [ProblemaController::class, 'all']);

    });

    //OBRAS ------------------------------------------------------------------------------
    Route::prefix('obras')->group(function(){

        //orgao
        Route::post('obra/{id}/orgao_relacionados', [ApiObraController::class, 'getObraOrgaoRelacionados']);
        Route::post('obra/{obra_id}/orgao/{orgao_id}/relacionar', [ApiObraController::class, 'getObraOrgaoRelacionar']);
        Route::post('obraOrgao/{id}/excluir', [ApiObraController::class, 'ObraOrgaoexcluir']);
        Route::post('obraOrgao/filter/orgao', [ApiObraController::class, 'filterOrgao']);
        Route::post('obraOrgao/{id}/principal', [ApiObraController::class, 'ObraOrgaoPrincipal']);

        //cidade
        Route::post('obra/{id}/cidade_relacionados', [ApiObraController::class, 'getObraCidadeRelacionados']);
        Route::post('obra/{obra_id}/cidade/{cidade_id}/relacionar', [ApiObraController::class, 'getObraCidadeRelacionar']);
        Route::post('obraCidade/{id}/excluir', [ApiObraController::class, 'ObraCidadeExcluir']);
        Route::post('obraCidade/filter/cidade', [ApiObraController::class, 'filterCidade']);

        Route::post('regiao/{regiao_id}/cidade', function($regiao_id){
            if($regiao_id == 0){
                $regiao = DB::table('cidade')->get();
            }else{
                $regiao = DB::table('cidade')->where('regiao_id',$regiao_id)->get();
            }
            return $regiao;
        });

        //valor da obras
        Route::get('obra/{obra_id}/valor/lista', [ApiObraController::class,'lista']);
        Route::get('obra/{obra_id}/valor/{valor_id}', [ApiObraController::class,'find_valor']);
        Route::post('obra/{obra_id}/valor/novo', [ApiObraController::class,'valor_novo']);
        // Route::get('obra/{obra_id}/valor/{id}/editar', [ApiObraController::class,'valor_editar']);
        Route::post('obra/{obra_id}/valor/{id}/update', [ApiObraController::class,'valor_update']);
        Route::post('obra/{obra_id}/valor/{id}/delete', [ApiObraController::class,'valor_delete']);

    });


    Route::get('webservice/obras', function(Request $request){

        $sql  = " select o.* from obra o ";
        $sql .= " inner join obra_orgao oo on oo.obra_id = o.id ";
        $sql .= " where 1 = 1 ";
        $sql .= " and oo.obra_id = 39 ";
        $sql .= " order by o.id ";
        $obras = DB::select($sql);

        $a = array();
        foreach ($obras as $value){
            $obj = new \stdClass();
            $obj->id = $value->id;
            $obj->descricao = $value->descricao;
            $obj->prioritaria = $value->prioritaria==1?"Sim":"Não";
            $obj->dt_atualizacao = $value->dt_atualizacao;
            $obj->igesp = $value->igesp;
            $obj->setor = setor($value->setor_id);
            $obj->modalidade = modalidade($value->modalidade_id);
            $obj->tipologia = tipologia($value->tipologia_id);
            $obj->percentual_execucao_financeira = $value->percentual_execucao_financeira;
            $obj->status_fases = status_fases($value->status_fases);
            $obj->fase_licitacao = fase_licitacao($value->fase_licitacao_id);
            $obj->inaugurada = $value->inaugurada;
            $obj->local = $value->local;
            $obj->valor_inicial = $value->valor_inicial;
            $obj->valor_investido = $value->valor_investido;
            $obj->fonte = $value->fonte;
            $obj->percentual = $value->percentual;
            $obj->paralisacao = $value->paralisacao;
            $obj->obracol = $value->obracol;
            $obj->status = status($value->status_id);
            $obj->desapropriacao = $value->desapropriacao;
            $obj->licenca_ambiental_previa = $value->licenca_ambiental_previa;
            $obj->licenca_ambiental_instalacao = $value->licenca_ambiental_instalacao;
            $obj->projeto_basico = $value->projeto_basico;
            $obj->projeto_executivo = $value->projeto_executivo;
            $obj->titularidade = $value->titularidade;
            $obj->licenca_outros_orgaos = $value->licenca_outros_orgaos;
            $obj->especifique_orgaos = $value->especifique_orgaos;
            $obj->dt_inicio = $value->dt_inicio;
            $obj->dt_conclusao_prevista = $value->dt_conclusao_prevista;
            $obj->dt_conclusao_realizada = $value->dt_conclusao_realizada;
            $obj->prazo_entrega = $value->prazo_entrega;
            $obj->percentual_execucao_fisica = $value->percentual_execucao_fisica;
            $obj->dt_assinatura_contrato = $value->dt_assinatura_contrato;
            $obj->obs = $value->obs;
            $obj->descricao_estagio = $value->descricao_estagio;
            $obj->descricao_proxima_fase = $value->descricao_proxima_fase;
            $obj->descricao_pendencias_prazo = $value->descricao_pendencias_prazo;
            $obj->status = status($value->status);
            $obj->created_at = $value->created_at;
            $obj->updated_at = $value->updated_at;
            $obj->updated_at_user = $value->updated_at_user;
            $obj->projeto = projeto($value->projeto_id);

            //CIDADES
            $sql  = " select c.nome from obra_cidade oc ";
            $sql .= " inner join cidade c on c.id = oc.cidade_id ";
            $sql .= " where oc.obra_id = ". $obj->id;
            $obra_cidade = DB::select($sql);
            $b = array();
            foreach ($obra_cidade as $key => $value) {
                $obj1 = new \stdClass();
                $obj1->nome = $value->nome;
                array_push($b, $obj1);
            }
            $obj->cidades = $b;

            //ORGAOS RESPONSAVEIS
            $sql  = " select o.sigla, o.nome from obra_orgao oo ";
            $sql .= " inner join orgao o on o.id = oo.orgao_id ";
            $sql .= " where oo.obra_id = ". $obj->id;
            $obra_orgao = DB::select($sql);
            $b = array();
            foreach ($obra_orgao as $key => $value) {
                $obj1 = new \stdClass();
                $obj1->sigla = $value->sigla;
                $obj1->nome = $value->nome;
                array_push($b, $obj1);
            }
            $obj->orgaos_responsaveis = $b;

            //FONTE DE RECURSOS
            $sql  = " select fonte, valor from obra_valor ";
            $sql .= " where obra_id = ". $obj->id;
            $obra_valor = DB::select($sql);
            $b = array();
            foreach ($obra_valor as $key => $value) {
                $obj2 = new \stdClass();
                $obj2->fonte = $value->fonte;
                $obj2->valor = $value->valor;
                array_push($b, $obj2);
            }
            $obj->fonte_de_recusrso = $b;


            array_push($a, $obj);
        }


        // dd($obra);

        return response()->json($a);
    });

});