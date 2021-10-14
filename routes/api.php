<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors'])->group(function(){
    Route::prefix('planejamento')->group(function(){

        Route::get('get_plano', function (){
            $a = DB::table('plano')->get();            
            return response()->json($a);
        });

        Route::post('get_perspectiva', function (Request $request){

            dd( $request->all() );

            $a = DB::table('plano')->get();
            return response()->json($a);
        });

    });
});