@extends('obras.layout.app')
@section('content')

<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'cronograma'; ?>
           @include('obras.obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <br>
              <h4>{{$obra->descricao}} </h4><br>
              <span class="titulo"> Data da início: </span> {{dateBr2($obra->dt_inicio)}} <br>
              <span class="titulo"> Data de conclusão prevista: </span> {{dateBr2($obra->dt_conclusao_prevista)}} <br>
              <br>

              <form role="form" action="" method="post"> 
              {{ csrf_field() }}

              <div class="row">
                <div class="col-md-8">

                    <div class="row">
                      <div class="col-md-5">
                        <label for="atividade">Atividade</label>
                        <input type="text" class="form-control" id="atividade" name="atividade" placeholder="" 
                        value="@isset(session()->get('obra_cronograma_filtro')['atividade'])  {{session()->get('obra_cronograma_filtro')['atividade']}} @endisset"> 
                      </div>

                      <div class="col-md-1 mb-3">
                        <label for="dt_termino">.</label><br>
                        <input type="hidden" name="obra_id" value="{{$obra->id}}">
                        <button class="btn btn-primary" type="submit">Filtrar</button>
                      </div>  
                    </div>

                </div>  

                <div class="col-md-4">
                    <p class="text-right">
                    <a href="{{url('obras/obra/'.$obra->id.'/cronograma/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small"> Novo </a>
                    </p>
                </div>
              </div>

              </form>
              <br>

              <div class="row">                  
              <div class="col col-md-12">

                  <div class="table-responsive table-responsive-data2">
                  <table id="sortable" class="table table-data2">
                      <thead>
                          <tr>
                              <!-- <th width="5%">index</th> -->
                              <!-- <th width="5%">id</th> -->
                              <th>Nº</th>
                              <th>Atividades/Epatas</th>
                              <th>Responsável</th>
                              <th>Início</th>
                              <th>Término</th>
                              <th>Prazo</th>
                              <th>Status</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>

                          @foreach ($cronograma as $value)
                          <tr id="{{$value->id}}" class="tr-shadow">
                              <!-- <td>{{$value->index}}</td> -->
                              <!-- <td>{{$value->id}}</td> -->
                              <td>{{$value->pos}}</td>
                              <td>{{$value->atividade}}</td>
                              <td>{{$value->responsavel}}</td>
                              <td>{{dateBR2($value->dt_inicio)}}</td>
                              <td>{{dateBR2($value->dt_termino)}}</td>
                              <td>{{$value->prazo}}</td>
                              <td>{{statusCronograma($value->status_id)}}</td>
                              <td>
                                  <div class="table-data-feature">
                                      <a href="{{url('obras/obra/'.$value->obra_id.'/cronograma/'.$value->id.'/editar')}}" 
                                        class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                          <i class="zmdi zmdi-edit"></i>
                                      </a>
                                      <a href="{{url('obras/obra/'.$value->obra_id.'/cronograma/'.$value->id.'/delete')}}" 
                                        class="item" data-toggle="tooltip" data-placement="top" title="Excluir">
                                          <i class="zmdi zmdi-delete"></i>
                                      </a>
                                  </div>
                              </td>
                          </tr>
                          <tr class="spacer"></tr>
                          @endforeach

                      </tbody>
                  </table>
                  </div>

        	</div>        		
        	</div>

        </div>
        </div>
    </div>
    </section>

</div>

<!--Arasta e solta : ordenar a fileira na table-->
<script>

  var url1 = "<?= env('APP_URL'); ?>"+"/api/cronograma/ordem"  ;

  var obra_id = "<?= $obra->id?>"

  $("#sortable tbody").sortable( {
    update: function(){
      var lista = $('#sortable tbody').sortable('toArray');
      console.log(lista);
      $.post(url1,{lista:lista, obra_id: obra_id}, function(){
         // alert('Sucesso');
      });
    }
  });
</script> 

@endsection
