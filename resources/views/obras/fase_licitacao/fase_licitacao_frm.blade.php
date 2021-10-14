@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    @if (session('msg'))
    <div class="alert alert-success"> {{ session('msg') }} </div>
    @endif

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 offset-3">

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <h3 class="title-5 m-b-35">Fase licitação</h3>

              <form action="" method="post" novalidate="novalidate">
              {{ csrf_field() }}

                  <div class="form-group">
                      <label for="nome" class="control-label mb-1">Nome</label>
                      <input id="nome" name="nome" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($fase_licitacao->nome)?$fase_licitacao->nome:'' ?>">
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{url('fase_licitacao')}}" class="btn btn-danger">Voltar</a>
                  </div>

              </form>

        		</div>
        		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        			<h3>Menu 1</h3>
        			<p>Some content here.</p>
        		</div>
        		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        			<h3>Menu 2</h3>
        			<p>Some content here.</p>
        		</div>
        	</div>
        </div>
        </div>
    </div>
    </section>

</div>
@endsection
