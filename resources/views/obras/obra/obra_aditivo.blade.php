@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'aditivo'; ?>
           @include('obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
              <br> <h5>Obra: {{$obra->descricao}}</h5> <br>

              <a href="{{url('/obra/'.$obra->id.'/aditivo/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                  <i class="zmdi zmdi-plus"></i>Novo
              </a>
              <br>
              <br>

              <div class="row">                  
                  <div class="col col-md-10">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th width="5%">#</th>
                                  <th>Valor</th>                                  
                                  <th>Data</th>
                                  <!-- <th>Atualizado</th> -->
                                  <th></th>                                  
                                  <th></th>                                  
                              </tr>
                          </thead>
                          <tbody>  
                              <?php $soma = 0 ;?>
                              @foreach($aditivo as $value)
                              <?php $soma = $soma + $value->valor; ?>
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td>R$  <?= number_format($value->valor,2,",",".");  ?>  </td>                                  
                                  <td>{{dateBR($value->dt_inclusao)}}</td>                                  
                                  <!-- <td>{{dateBR($value->updated_at)}}</td>                                   -->
                                  <td>
                                    <div class="table-data-feature">
                                    <a href="{{url('/obra/'.$obra->id.'/aditivo/'.$value->id.'/editar')}}" class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                      <i class="zmdi zmdi-edit"></i>
                                    </a>                                  
                                    <a href="{{url('/obra/'.$obra->id.'/aditivo/'.$value->id.'/excluir')}}" class="item" data-toggle="tooltip" data-placement="top" title="Excluir">
                                      <i class="zmdi zmdi-delete"></i>
                                    </a> 
                                    </div>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                                  <th width="5%"></th>
                                  <th>Soma: R$ <?=$soma?></th>                                  
                              </tr>
                          </tfoot>
                      </table>
                  </div>                  
                  </div>
              </div>


        	</div>        		
        	</div>

        </div>
        </div>
    </div>
    </section>

</div>
@endsection
