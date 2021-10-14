@extends('layout.admin.app')
@section('content')

<form role="form" method="post" id="meuFormulario" name="meuFormulario" action="">
{{ csrf_field() }}

<div class="content-wrapper">
<section class="content">
<div class="row">
<div class="col-md-6 col-md-offset-2"> 

    <!-- <section> <h1> Seu perfil </h1> </section> -->

    <div class="row">
    <div class="col-md-12">

      <form  role="form" method="post" action="" enctype="multipart/form-data">
        
          <h1>Alterar Senha</h1>                   
          
          @if (session('vermelho'))
              <span style="color: red;"> {{ session('vermelho') }} </span> <br><br>
          @endif

          @if (session('verde'))
              <span style="color: green;"> {{ session('verde') }} </span> <br><br>
          @endif

          <div class="form-group">
            <label for="name">Nova senha</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <div class="form-group">
            <label for="name">Confirme a senha</label>
            <input type="password" class="form-control" id="password2" name="password2">
          </div>        

          <div class="form-group">              
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('admin/users/'.session()->get('userLogado')['id'].'/meu_cadastro') }}" class="btn btn-danger">Cancelar</a>
          </div>

      </form>
    
    </div>
    </div>


</div>
</div>
</section>
</div>
@endsection


