@extends('layout.app')
@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Objetivo</h1>
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
						<input type="text" name="nome" class="form-control form-control-sm" placeholder="nome" <?php if(isset($objetivo->nome)){ ?> value="{{ $objetivo->nome }}" <?php } ?>>
					</div>
					<div class="form-group">
						<label for="per_id">Per Id</label>
						<input type="text" name="per_id" class="form-control form-control-sm" placeholder="per_id" <?php if(isset($objetivo->per_id)){ ?> value="{{ $objetivo->per_id }}" <?php } ?>>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-secondary btn-sm">Salvar</button>
						<a href="{{ env('APP_URL').'objetivo'}}" class="btn btn-outline-danger btn-sm">Voltar</a>
					</div>
				</form>
</div></div>				</div>
			</div>

		</div>
	</div>
</div>
@endsection
