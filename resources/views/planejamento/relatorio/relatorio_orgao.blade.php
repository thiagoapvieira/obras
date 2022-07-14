@extends('planejamento.layout.app')
@section('content')
<div class="page-content--bgf7">

    <br>
    <section class="p-t-20">
    <div class="container">

	    <!-- TITULO -->
	    <div class="row">
		    <div class="col-md-10 offset-md-1" >

		    	<h4 class="text-center">{{$orgao->nome}}</h4>
		    	<h4 class="text-center">{{$ano}}</h4>
		    	<br>

		    </div>
	    </div>

	    <!-- RESUMO -->
	    <div class="row">
		    <div class="col-md-10 offset-md-1" >

		    	<div class="card">
		    	  <h5 class="card-header">RESUMO</h5>
		    	  <div class="card-body">

		    	  	    <div class="row">
		    	  		    <div class="col-md-6" >
		    	  		    	<div class="card" style="margin-top: 20px;">
		    	  		    		<div class="text-center" style="padding: 30px 0 0 0">NOTA:</div>
		    	  		    		<div class="text-center" style="padding: 30px 0 30px 0; font-size: 50px;">{{$nota==null?0:$nota->nota}}%</div>
		    	  		    	</div>
		    	  		    </div>
		    	  		    <div class="col-md-6" >
		    	  		    	<div class="card" style="margin-top: 20px;">
		    	  		    		<div class="text-center" style="padding: 30px 0 0 0">ÍNDICE DE DESAFIO SETORIAL:</div>
		    	  		    		<div class="text-center" style="padding: 30px 0 30px 0; font-size: 50px;">{{$nota==null?0:$nota->indice}}%</div>
		    	  		    	</div>
		    	  		    </div>
		    	  		</div>

		    	  </div>
		    	</div>

		    </div>
	    </div>



	    <!-- OBJETIVOS ESTRATÉGICOS -->
        <div class="row">
    	    <div class="col-md-10 offset-md-1" >

    	    	<div class="card">
    	    	  <h5 class="card-header">OBJETIVOS ESTRATÉGICOS</h5>
    	    	  <div class="card-body">

    	    	  	    <div class="row">

    	    	  	    	@foreach( $indicador as $value)
    	    	  		    <div class="col-md-4" >
    	    	  		    	<div class="card">
    	    	  		    		<div class="text-center" style="padding: 30px 0 0 0"> {{$value->nome}} </div>
    	    	  		    		<div class="text-center" style="padding: 30px 0 30px 0">Realizado em {{$value->ano}} <br> {{ number_format($value->realizado, 2, '.', '') }}%</div>
    	    	  		    	</div>
    	    	  		    </div>
    	    	  	    	@endforeach

    	    	  		</div>

    	    	  </div>
    	    	</div>

    	    </div>
        </div>


        <!-- INDICADORES -->
        <div class="row">
    	    <div class="col-md-10 offset-md-1" >

    	    	<div class="card">
    	    	  <h5 class="card-header">INDICADORES</h5>
    	    	  <div class="card-body">

    	    	  	    <div class="row">
    	    	  		    <div class="col-md-10" >
    	    	  		    	Indicadores {{$ano}}
    	    	  		    </div>
    	    	  		    <div class="col-md-2" >
    	    	  		    	{{$qtd_indicadores_ano}}
    	    	  		    </div>
    	    	  		</div>

    	    	  		<div class="row">
    	    	  		    <div class="col-md-10" >
    	    	  		    	Cumprimento total
    	    	  		    </div>
    	    	  		    <div class="col-md-2" >
    	    	  		    	{{$qtd_cumprimento_total}}
    	    	  		    </div>
    	    	  		</div>

    	    	  		<div class="row">
    	    	  		    <div class="col-md-10" >
    	    	  		    	Cumprimento percial
    	    	  		    </div>
    	    	  		    <div class="col-md-2" >
    	    	  		    	{{$qtd_cumprimento_parcial}}
    	    	  		    </div>
    	    	  		</div>

    	    	  		<div class="row">
    	    	  		    <div class="col-md-10" >
    	    	  		    	Não cumprimento
    	    	  		    </div>
    	    	  		    <div class="col-md-2" >
    	    	  		    	{{$qtd_nao_cumprimento}}
    	    	  		    </div>
    	    	  		</div>

    	    	  </div>
    	    	</div>

    	    </div>
        </div>


	    <!-- PRINCIPAIS PROBLEMAS -->
        <div class="row">
    	    <div class="col-md-10 offset-md-1" >

    	    	<div class="card">
    	    	  <h5 class="card-header">PRINCIPAIS PROBLEMAS</h5>
    	    	  <div class="card-body">

	    	  	    	<table class="table table-data2">
	    	  	    	    <thead>
	    	  	    	        <tr>
	    	  	    	            <th>Problemas enfrentados {{2019}}</th>
	    	  	    	            <th width="6%">Fase</th>
	    	  	    	        </tr>
	    	  	    	    </thead>
	    	  	    	    <tbody>
	    	    	  	    	@foreach ($principais_problemas as $value)
	    	    	  	    	<tr class="tr-shadow">
	    	    	  	    	    <td>{{$value->nome}}</td>
	    	    	  	    	    <td>{{$value->qtd}}</td>
	    	    	  	    	</tr>
	    	    	  	    	<tr class="spacer"></tr>
	    	    	  	    	@endforeach
    	    	  	        </tbody>
    	    	  	    </table>

    	    	  </div>
    	    	</div>

    	    </div>
        </div>



	    <!-- LISTA DE INDICADORES -->
        <div class="row">
    	    <div class="col-md-10 offset-md-1" >

    	    	<div class="card">
    	    	  <h5 class="card-header">LISTA DE INDICADORES</h5>
    	    	  <div class="card-body" style="font-size: 10px;">

    	    	  		@foreach ($array_per as $perspectiva)
    	    	  			<span style="color:blue;">* {{$perspectiva->nome}}</span> <br>

    	    	  			@foreach ($perspectiva->objeto as $objeto)
    	    	  				<span style="color:yellow;"> &nbsp;&nbsp; - {{$objeto->nome}} </span> <br>

    	    	  				@foreach ($objeto->estrategia as $estrategia)
    	    	  					&nbsp;&nbsp;&nbsp; - {{$estrategia->nome}}<br>

    	    	  					@foreach ($estrategia->indicador as $indicador)

    	    	  						&nbsp;&nbsp;&nbsp;&nbsp; - {{$indicador->nome}}<br>

    	    	  					@endforeach

    	    	  				@endforeach

    	    	  				<br><br>

    	    	  			@endforeach

    	    	  			<br><br>

    	    	  		@endforeach

    	    	  		<br>
    	    	  		<br>

    	    	  		OBJETIVO

    	    	  		ESTRATEGIA

	    	  	    	<table class="table table-data2">
	    	  	    	    <thead>
	    	  	    	        <tr>
	    	  	    	            <th>Problemas enfrentados</th>
	    	  	    	            <th width="6%">Fase</th>
	    	  	    	        </tr>
	    	  	    	    </thead>
	    	  	    	    <tbody>
	    	    	  	    	<tr class="tr-shadow">
	    	    	  	    	    <td>value->nome</td>
	    	    	  	    	</tr>
	    	    	  	    	<tr class="spacer"></tr>
    	    	  	        </tbody>
    	    	  	    </table>

    	    	  </div>
    	    	</div>

    	    </div>
        </div>





    </div>
    </section>
    <br><br><br><br><br><br>

</div>
@endsection