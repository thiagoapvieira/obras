@extends('layout.app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
<div class="container">

<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0">Estrategia</h1>
	</div>
	<div class="col-sm-6">
		<div class="float-sm-right">
			<a href="{{env('APP_URL').'estrategia/novo'}}" type="button" class="btn btn-outline-info btn-sm">+ Novo</a> 
		</div>
	</div>
</div>
<br>

<div class="row mb-2">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
			<div class="card-tools">
				<form class="form-inline" role="form" action="" method="post">
				{{csrf_field()}}
					<div class="input-group input-group-sm">
						<input type="text" name="pesq" class="form-control float-right" placeholder="Filtro.." value="{{session()->get('estrategia_filtro')['pesq']}}" autofocus>
						<div class="input-group-append">
							<button type="submit" class="btn btn-default">
							<i class="fas fa-search"></i>
							</button>
							<a href="{{ env('APP_URL').'estrategia/limpar'}}" type="submit" class="btn btn-default"><i class="fas fa-magic"></i></a>						</div>
					</div>
				</form>
			</div>
			</div>


			<div class="card-body p-0">
			<table class="table">
				<thead>
				<tr>
				<th style="width: 10px">#</th>
				<th>Nome</th>
				<th style="width: 15%"></th>
				</tr>
				</thead>
				<tbody>
				@foreach ($estrategia as $value)
					<tr>
					<td>{{$value->id}}</td>
					<td>{{$value->nome}}</td>
					<td class="text-right"> 
					<a href="{{ env('APP_URL').'estrategia/'.$value->id.'/editar'}}" type="button" class="btn btn-outline-secondary btn-xs">editar</a>
					<a href="{{ env('APP_URL').'estrategia/'.$value->id.'/excluir'}}" type="button" class="btn btn-outline-danger btn-xs" onClick="return confirm('Deseja realmente excluir?')">excluir</a>
					</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>


@endsection
