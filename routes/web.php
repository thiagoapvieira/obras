<?php

use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
    
/*login*/
Route::get('/', 'App\Http\Controllers\LoginController@index');
Route::post('/', 'App\Http\Controllers\LoginController@validar');
Route::get('login', 'App\Http\Controllers\LoginController@index');
Route::post('login', 'App\Http\Controllers\LoginController@validar'); 
Route::get('login/sair', 'App\Http\Controllers\LoginController@sair');

Route::middleware(['userLogado'])->group(function(){

    /*inicio*/
    Route::get('home', 'App\Http\Controllers\HomeController@index');

    /*usuarios*/
    Route::get('usuario', 'App\Http\Controllers\UsuariosController@index');
    Route::post('usuario', 'App\Http\Controllers\UsuariosController@filter');    


    // --SUPLAN -----------------------------------------------------------------------------------------

    Route::prefix('planejamento')->group(function(){

        //inicio
        Route::get('inicio', 'App\Http\Controllers\Planejamento\InicioController@index');

        //perspectiva
        Route::get('plano/{plano_id}/perspectiva', 'App\Http\Controllers\Planejamento\PerspectivaController@index');
        //Route::post('perspectiva/novo/editar', 'App\Http\Controllers\Planejamento\PerspectivaController@save_update');        

    }); 


    //--OBRAS----------------------------------------------------------------

    Route::prefix('obras')->group(function(){

        //painel
        Route::get('painel', 'App\Http\Controllers\Obras\ObraPainelController@index');
        Route::get('painel/consolidar_calculo', 'App\Http\Controllers\Obras\ObraPainelController@consolidar_calculo');

        /*obra*/
        Route::get('obra', 'App\Http\Controllers\Obras\ObraController@obra');
        Route::post('obra', 'App\Http\Controllers\Obras\ObraController@filter');
        Route::get('obra/filter_limpar', 'App\Http\Controllers\Obras\ObraController@filterLimpar');
        Route::get('obra/novo', 'App\Http\Controllers\Obras\ObraController@create');
        Route::post('obra/novo', 'App\Http\Controllers\Obras\ObraController@save');
        Route::get('obra/{id}/editar', 'App\Http\Controllers\Obras\ObraController@edit');
        Route::post('obra/{id}/editar', 'App\Http\Controllers\Obras\ObraController@update');
        Route::get('obra/{id}/excluir', 'App\Http\Controllers\Obras\ObraController@delete');
        Route::get('obra/{obra_id}/view', 'App\Http\Controllers\Obras\ObraController@view');
        Route::get('obra/excel', 'App\Http\Controllers\Obras\ObraController@excel');

    });       

});