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

            $perspectiva = DB::table('perspectiva')->where('plano_id', $request->plano_id)->get();

            $array_per = array();
            foreach ($perspectiva as $value) {
                $obj = new \stdClass();
                $obj->id = $value->id;
                $obj->plano_id = $value->plano_id;
                $obj->nome = $value->nome;
                $obj->ativo = $value->ativo;

                    $objetivo = DB::table('objetivo')->where('per_id',$value->id)->get();
                    $array_obj = array();
                    foreach ($objetivo as $value) {
                        $obj2 = new \stdClass();
                        $obj2->id = $value->id;
                        $obj2->per_id = $value->per_id;
                        $obj2->nome = $value->nome;
                        $obj2->ativo = $value->ativo;                        

                            $estrategia = DB::table('estrategia')->where('obj_id',$value->id)->get();
                            $array_est = array();
                            foreach ($estrategia as $value) {
                                $obj3 = new \stdClass();
                                $obj3->id = $value->id;                            
                                $obj3->nome = $value->nome;
                                array_push($array_est, $obj3);

                                $indicador = DB::table('indicador')->where('est_id',$value->id)->get();
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



        Route::post('save_objetivo', 'App\Http\Controllers\Planejamento\ObjetivoController@save');

        Route::post('save_estrategia', 'App\Http\Controllers\Planejamento\EstrategiaController@save');

        Route::get('indicador/find/{id}', function ($id){
            
            $indicador = DB::table('indicador')->where('id',$id)->get();

            $array_ind = array();
            foreach ($indicador as $value) {
                $obj = new \stdClass();
                $obj->id = $value->id;
                $obj->est_id = $value->est_id;
                $obj->nome = $value->nome;
                $obj->meta_agregada = $value->meta_agregada;
                $obj->realizado_acumulado = $value->realizado_acumulado;
                $obj->execucao_agregada = $value->execucao_agregada;
                $obj->status = $value->status;
                $obj->responsavel = $value->responsavel;
                $obj->ativo = $value->ativo;

                    $meta = DB::table('indicador_meta')->where('indicador_id',$value->id)->get();                    
                    $array_meta = array();
                    foreach ($meta as $value) {
                        $obj1 = new \stdClass();
                        $obj1->id = $value->id;
                        $obj1->tipo = $value->tipo;
                        $obj1->ano = $value->ano;
                        $obj1->valor = $value->valor;
                        array_push($array_meta, $obj1);
                    }
                    $obj->meta = $array_meta;

                
                array_push($array_ind, $obj);
            }    

            return response()->json($array_ind);
        });

});
});