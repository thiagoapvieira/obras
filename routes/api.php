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

Route::middleware(['cors'])->group(function(){
Route::prefix('planejamento')->group(function(){

        Route::get('get_plano', function (){
            $a = DB::table('plano')->get();
            return response()->json($a);
        });

        //consuta
        Route::post('consulta', [ConsultaController::class, 'consulta2']);

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
});