@extends('planejamento.layout.app')
@section('content')
<div class="page-content--bgf7">

    <br>
    <section class="p-t-20">
    <div class="container-fluid">

	    <!-- TITULO -->
	    <div class="row">
		    <div class="col-md-10 offset-md-1" >
		    	<h4 class="text-center">Relatório por orgão</h4>
		    	<br>
		    </div>
	    </div>

	    <!-- RESUMO -->
	    <div class="row">
		    <div class="col-md-4 offset-md-4" >

				<form action="" method="post" novalidate="novalidate">
				{{ csrf_field() }}

				    <div class="form-group">
				        <label for="orgao_id" class="control-label mb-1">Selecione um orgão</label>

				        <!-- <input id="orgao_id" name="orgao_id" type="text" class="form-control" aria-required="true" aria-invalid="false"> -->

				        <select name="orgao_id" id="SelectLm" class="form-control form-control">
                            <option value="0">Selecione um orgão</option>
                            @foreach($orgao as $v)
                            <option value="{{$v->id}}">{{$v->sigla}} - {{$v->nome}}</option>
                            @endforeach
                        </select>
				    </div>

				    <div class="form-group">
				        <label for="ano" class="control-label mb-1">Digite o ano</label>
				        <input id="ano" name="ano" type="text" class="form-control" aria-required="true" aria-invalid="false">
				    </div>

				    <div class="box-footer">
				      <button type="submit" class="btn btn-primary">Buscar</button> 	
				      <a href="{{url('planejamento/plano')}}" class="btn btn-danger">Voltar</a>
				    </div>

				</form>

		    </div>
	    </div>


    </div>
    </section>
    <br><br><br><br><br><br>

</div>
@endsection