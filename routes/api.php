<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;



Route::middleware(['cors'])->group(function(){    
Route::prefix('planejamento')->group(function(){

        Route::get('get_plano', function (){
            $a = DB::table('plano')->get();            
            return response()->json($a);
        });


        Route::post('consulta', function (Request $request){

            $perspectiva = DB::table('perspectiva')->where('ativo',1)->where('plano_id', $request->plano_id)->get();

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

                                $indicador = DB::table('indicador')->where('ativo',1)->where('est_id',$value->id)->get();
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
            
            //return $array_per;

            return response()->json($array_per);            

        });

        //perspectiva
        Route::get('perspectiva/delete/{id}', 'App\Http\Controllers\Planejamento\PerspectivaController@delete');
        Route::post('perspectiva/save', 'App\Http\Controllers\Planejamento\PerspectivaController@save');

        //objetivo
        Route::post('save_objetivo', 'App\Http\Controllers\Planejamento\ObjetivoController@save');
        Route::get('objetivo/delete/{id}', 'App\Http\Controllers\Planejamento\ObjetivoController@delete');

        //estrategia
        Route::post('save_estrategia', 'App\Http\Controllers\Planejamento\EstrategiaController@save');
        Route::get('estrategia/delete/{id}', 'App\Http\Controllers\Planejamento\EstrategiaController@delete');

        //indicador
        Route::get('indicador/find/{id}', 'App\Http\Controllers\Planejamento\IndicadorController@find');
        Route::post('indicador/save', 'App\Http\Controllers\Planejamento\IndicadorController@save');
        Route::post('indicador/inserir_novo_ano_meta_indicador', 'App\Http\Controllers\Planejamento\IndicadorController@inserir_novo_ano_meta_indicador');
        Route::post('indicador/delete_ano_meta_indicador', 'App\Http\Controllers\Planejamento\IndicadorController@delete_ano_meta_indicador');

});
});