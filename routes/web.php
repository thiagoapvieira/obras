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

        /*obra cidade*/
	  	Route::get('obra/{obra_id}/cidade', 'App\Http\Controllers\Obras\ObraController@cidade_obra');

	  	/*obra orgao*/
	  	Route::get('obra/{obra_id}/orgao', 'App\Http\Controllers\Obras\ObraController@orgaos_obra');

		/*obra aditivo*/
	  	Route::get('obra/{obra_id}/aditivo', 'App\Http\Controllers\Obras\ObraController@aditivo_obra');
	  	Route::get('obra/{obra_id}/aditivo/novo', 'App\Http\Controllers\Obras\ObraController@aditivo_obra_create');
	  	Route::post('obra/{obra_id}/aditivo/novo', 'App\Http\Controllers\Obras\ObraController@aditivo_obra_save');
	  	Route::get('obra/{obra_id}/aditivo/{aditivo_id}/editar', 'App\Http\Controllers\Obras\ObraController@aditivo_obra_edit');
	  	Route::post('obra/{obra_id}/aditivo/{aditivo_id}/editar', 'App\Http\Controllers\Obras\ObraController@aditivo_obra_update');
	  	Route::get('obra/{obra_id}/aditivo/{aditivo_id}/excluir', 'App\Http\Controllers\Obras\ObraController@aditivo_obra_excluir');

	  	/*obra cronograma*/
	  	Route::get('obra/{obra_id}/cronograma', 'App\Http\Controllers\Obras\ObraCronogramaController@liste');
	  	Route::post('obra/{obra_id}/cronograma', 'App\Http\Controllers\Obras\ObraCronogramaController@filter');
	  	Route::get('obra/{obra_id}/cronograma/filter_limpar', 'App\Http\Controllers\Obras\ObraCronogramaController@filterLimpar');
	  	Route::get('obra/{obra_id}/cronograma/novo', 'App\Http\Controllers\Obras\ObraCronogramaController@create');
	  	Route::post('obra/{obra_id}/cronograma/novo', 'App\Http\Controllers\Obras\ObraCronogramaController@save');
	  	Route::get('obra/{obra_id}/cronograma/{id}/editar', 'App\Http\Controllers\Obras\ObraCronogramaController@editar');
	  	Route::post('obra/{obra_id}/cronograma/{id}/editar', 'App\Http\Controllers\Obras\ObraCronogramaController@update');
	  	Route::get('obra/{obra_id}/cronograma/{id}/delete', 'App\Http\Controllers\Obras\ObraCronogramaController@delete');

	  	/*obra imagem*/
	  	Route::get('obra/{obra_id}/imagem', 'App\Http\Controllers\Obras\ObraImagemController@obra_imagem');
	  	Route::post('obra/{obra_id}/imagem', 'App\Http\Controllers\Obras\ObraImagemController@image_upload');
	  	Route::get('obra/{obra_id}/imagem/{obra_imagem_id}/delete', 'App\Http\Controllers\Obras\ObraImagemController@image_delete');

	  	/*obra anexo*/
	  	Route::get('obra/{obra_id}/anexo', 'App\Http\Controllers\Obras\ObraAnexoController@obra_anexo');
	  	Route::post('obra/{obra_id}/anexo', 'App\Http\Controllers\Obras\ObraAnexoController@anexo_upload');
	  	Route::get('obra/{obra_id}/anexo/{obra_imagem_id}/delete', 'App\Http\Controllers\Obras\ObraAnexoController@anexo_delete');

	  	/*obra historico*/
	  	Route::get('obra/{obra_id}/historico', 'App\Http\Controllers\Obras\ObraHistoricoController@index');
	  	Route::get('obra/{obra_id}/historico/{id}', 'App\Http\Controllers\Obras\ObraHistoricoController@single');

        /*setor*/
		Route::get('setor', 'App\Http\Controllers\Obras\SetorController@index');
		Route::get('setor/novo', 'App\Http\Controllers\Obras\SetorController@create');
	  	Route::post('setor/novo', 'App\Http\Controllers\Obras\SetorController@save');
		Route::get('setor/{id}/editar', 'App\Http\Controllers\Obras\SetorController@edit');
		Route::post('setor/{id}/editar', 'App\Http\Controllers\Obras\SetorController@update');
	  	Route::get('setor/{id}/excluir', 'App\Http\Controllers\Obras\SetorController@delete');

        /*modalidade*/
		Route::get('modalidade', 'App\Http\Controllers\Obras\ModalidadeController@index');
		Route::get('modalidade/novo', 'App\Http\Controllers\Obras\ModalidadeController@create');
	  	Route::post('modalidade/novo', 'App\Http\Controllers\Obras\ModalidadeController@save');
		Route::get('modalidade/{id}/editar', 'App\Http\Controllers\Obras\ModalidadeController@edit');
		Route::post('modalidade/{id}/editar', 'App\Http\Controllers\Obras\ModalidadeController@update');
	  	Route::get('modalidade/{id}/excluir', 'App\Http\Controllers\Obras\ModalidadeController@delete');

	  	/*tipologia*/
		Route::get('tipologia', 'App\Http\Controllers\Obras\TipologiaController@index');
		Route::get('tipologia/novo', 'App\Http\Controllers\Obras\TipologiaController@create');
	  	Route::post('tipologia/novo', 'App\Http\Controllers\Obras\TipologiaController@save');
		Route::get('tipologia/{id}/editar', 'App\Http\Controllers\Obras\TipologiaController@edit');
		Route::post('tipologia/{id}/editar', 'App\Http\Controllers\Obras\TipologiaController@update');
	  	Route::get('tipologia/{id}/excluir', 'App\Http\Controllers\Obras\TipologiaController@delete');

	  	/*fase_licitacao*/
		Route::get('fase_licitacao', 'App\Http\Controllers\Obras\FaseLicitacaoController@index');
		Route::get('fase_licitacao/novo', 'App\Http\Controllers\Obras\FaseLicitacaoController@create');
	  	Route::post('fase_licitacao/novo', 'App\Http\Controllers\Obras\FaseLicitacaoController@save');
		Route::get('fase_licitacao/{id}/editar', 'App\Http\Controllers\Obras\FaseLicitacaoController@edit');
		Route::post('fase_licitacao/{id}/editar', 'App\Http\Controllers\Obras\FaseLicitacaoController@update');
	  	Route::get('fase_licitacao/{id}/excluir', 'App\Http\Controllers\Obras\FaseLicitacaoController@delete');

	  	/*projeto*/
		Route::get('projeto', 'App\Http\Controllers\Obras\ProjetoController@index');
		Route::get('projeto/novo', 'App\Http\Controllers\Obras\ProjetoController@create');
	  	Route::post('projeto/novo', 'App\Http\Controllers\Obras\ProjetoController@save');
		Route::get('projeto/{id}/editar', 'App\Http\Controllers\Obras\ProjetoController@edit');
		Route::post('projeto/{id}/editar', 'App\Http\Controllers\Obras\ProjetoController@update');
	  	Route::get('projeto/{id}/excluir', 'App\Http\Controllers\Obras\ProjetoController@delete');

    });

});