<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors'])->group(function(){
    Route::prefix('planejamento')->group(function(){

        Route::get('get_plano', function (){
            $a = DB::table('plano')->get();            
            return response()->json($a);
        });

        // Route::post('get_perspectiva', function (Request $request){

        //     dd( $request->all() );

        //     $a = DB::table('plano')->get();
        //     return response()->json($a);
        // });


        Route::post('consulta', function (Request $request){

            $perspectiva = DB::table('perspectiva')->limit(2)->get();
            // dd($perspectiva);
            
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
                                    $obj4->nome = $value->nome;                            
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



    });
});