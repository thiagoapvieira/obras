@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    @if (session('success'))
    <div class="alert alert-success"> {{ session('success') }} </div>
    @endif

    @if (session('danger'))
    <div class="alert alert-danger"> {{ session('danger') }} </div>
    @endif


      <section class="au-breadcrumb2">
      <div class="container">
          <div class="row">
          <div class="col-md-6 offset-3">

                    <div class="card">
                        
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><?= isset($id)?'Editar':'Novo'?> Usuário</h3>
                            </div>
                            <hr>
                            <form action="" method="post" novalidate="novalidate">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nome" class="control-label mb-1">Nome</label>
                                    <input id="cc-pament" name="nome" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($usuario->nome)?$usuario->nome:'' ?>">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="email" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($usuario->email)?$usuario->email:'' ?>">
                                </div>

                                <div class="row form-group">
                                    <div class="col-12 col-md-12">
                                        <label for="is_active" class="control-label mb-1">Status</label>
                                        <select name="is_active" id="select" class="form-control">
                                            <option value=1 @isset($usuario->is_active) @if ( $usuario->is_active == 1 ) selected @endif @endisset >Ativo</option>                                            
                                            <option value=0 @isset($usuario->is_active) @if ( $usuario->is_active == 0 ) selected @endif @endisset >Bloqueado</option>
                                        </select>
                                    </div>
                                </div>                          
                                                                
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-primary">Salvar</button>
                                  <a href="{{url('usuario')}}" class="btn btn-danger">Voltar</a>
                                </div>                            

                            </form>
                        </div>      
                    </div>

          </div>
          </div>
      </div>
      </section>


</div>
@endsection
