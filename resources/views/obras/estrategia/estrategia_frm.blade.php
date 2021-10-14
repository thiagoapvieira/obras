@extends('layout.app')
@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Estrategia</h1>
				</div>
			</div>
			<br>

			<div class="row mb-2">
				<div class="col-sm-12">
				@if (session('msg'))
				<p class="text-success">
				{{ session('msg') }}
				</p>
				@endif

<div class="card card-secondary"><div class="card-header"><h3 class="card-title">Cadastro</h3></div>				<form role="form" action="" method="post">
				{{ csrf_field() }}
<div class="card-body">					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" class="form-control form-control-sm" placeholder="nome" <?php if(isset($estrategia->nome)){ ?> value="{{ $estrategia->nome }}" <?php } ?>>
					</div>
					<div class="form-group">
						<label for="obj_id">Obj Id</label>
						<input type="text" name="obj_id" class="form-control form-control-sm" placeholder="obj_id" <?php if(isset($estrategia->obj_id)){ ?> value="{{ $estrategia->obj_id }}" <?php } ?>>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-secondary btn-sm">Salvar</button>
						<a href="{{ env('APP_URL').'estrategia'}}" class="btn btn-outline-danger btn-sm">Voltar</a>
					</div>
				</form>
</div></div>				</div>
			</div>

		</div>
	</div>
</div>
@endsection
