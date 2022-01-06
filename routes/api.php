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

});