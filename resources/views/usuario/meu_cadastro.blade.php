@extends('layout.admin.app')
@section('content')

<form role="form" method="post" id="meuFormulario" name="meuFormulario" action="">
{{ csrf_field() }}

<div class="content-wrapper">
<section class="content">
<div class="row">
<div class="col-md-6 col-md-offset-2"> 

    <div class="row">
    <div class="col-md-12">

          @if (session('success'))                    
            <br>
            <div class="alert alert-info alert-dismissible">  
                {{ session('success') }}
            </div>
            <br>
          @endif 

          <form  role="form" method="post" action="" enctype="multipart/form-data">

              <h1>Meu cadastro</h1> <br>
            
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" >
              </div>            

              <div class="form-group">              
              <div class="row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Salvar</button>
                  <a href="{{url('/admin/inicio')}}" class="btn btn-danger">Voltar</a>
                </div>
                <div class="col-md-3 col-md-offset-2">                                        
                  <a href="{{ url('admin/users/'.session()->get('userLogado')['id'].'/redefinir_senha') }}" class="btn btn-info">ALTERAR SENHA</a>
                </div>
              </div>
              </div>
            
          </form>

    </div>
    </div>                

</div>
</div>
</section>
</div>
@endsection





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


