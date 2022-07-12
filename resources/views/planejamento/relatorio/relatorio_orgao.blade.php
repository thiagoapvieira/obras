@extends('planejamento.layout.app')
@section('content')
<div class="page-content--bgf7">

    <br>
    <section class="p-t-20">
    <div class="container">

	    <!-- TITULO -->
	    <div class="row">
		    <div class="col-md-10 offset-md-1" >

		    	<h4 class="text-center">SECRETARIA DE ESTADO DA SEGURNÇA PÚBLICA</h4>
		    	<h4 class="text-center">2019</h4>
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
		    	  		    		<div class="text-center" style="padding: 30px 0 0 0">Nota:</div>
		    	  		    		<div class="text-center" style="padding: 30px 0 30px 0">{{$nota==null?0:$nota->nota}}</div>
		    	  		    	</div>
		    	  		    </div>
		    	  		    <div class="col-md-6" >
		    	  		    	<div class="card" style="margin-top: 20px;">
		    	  		    		<div class="text-center" style="padding: 30px 0 0 0">Índice:</div>
		    	  		    		<div class="text-center" style="padding: 30px 0 30px 0">{{$nota==null?0:$nota->indice}}</div>
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
    	    	  		    		<div class="text-center" style="padding: 30px 0 30px 0">{{$value->ano}}</div>
    	    	  		    	</div>
    	    	  		    </div>
    	    	  	    	@endforeach

    	    	  		</div>

    	    	  </div>
    	    	</div>

    	    </div>
        </div>


    </div>
    </section>
    <br><br><br><br><br><br>

</div>
@endsection