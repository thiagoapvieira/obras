@extends('layout.app')
@section('content')

<div class="page-content--bgf7">

    <!-- DATA TABLE-->
    <section class="p-t-20">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12" >
                    
        <!-- <h2 class="title-5 m-b-35">Obras</h2> -->

        <form role="form" action="" method="post"> 
        {{ csrf_field() }}  
        <div class="row">
            
            <div class="col-lg-12">

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="descricao">Descricão</label>
                  <input type="text" class="input-sm form-control-sm form-control" id="descricao" name="descricao" placeholder="" value="{{session()->get('obra_filtro')['descricao']}}"> 
                </div>
                <div class="col-md-3 mb-3">
                   <?php
                    if ( isset($filtro['dt_inicio']) or ($filtro['dt_inicio'] != '') ){
                        $dt_inicio = $filtro['dt_inicio']; 
                      // $date = date_create($filtro['dt_inicio']);
                      // $dt_inicio = date_format($date,"d/m/Y");
                    }else{
                      $dt_inicio = '';                        
                    }

                    if ( isset($filtro['dt_conclusao_realizada']) or ($filtro['dt_conclusao_realizada'] != '') ){
                        $dt_conclusao_realizada = $filtro['dt_conclusao_realizada']; 
                      // $date = date_create($filtro['dt_conclusao_realizada']);
                      // $dt_conclusao_realizada = date_format($date,"d/m/Y");
                    }else{
                      $dt_conclusao_realizada = '';                        
                    }
                  ?>
                  <label for="dt_inicio">Início</label>
                  <input id="dt_inicio" name="dt_inicio" type="text" class="input-sm form-control-sm form-control" aria-required="true" aria-invalid="false" value="<?= $dt_inicio?>">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="dt_conclusao_realizada">Fim</label>
                  <input id="dt_conclusao_realizada" name="dt_conclusao_realizada" type="text" class="input-sm form-control-sm form-control" aria-required="true" aria-invalid="false" value="<?= $dt_conclusao_realizada?>">
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationCustom01">Regiões</label>
                    <select class="input-sm form-control-sm form-control" id="regiao_id" name="regiao_id" onchange="getCidade()">
                        <option value=0> TODAS </option>;
                        @foreach($regiao as $value)
                        <option value={{$value->id}} <?= $value->id == $filtro['regiao_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationCustom01">Cidade</label>
                    <select class="input-sm form-control-sm form-control" id="cidade_id" name="cidade_id">
                      <option value=0> TODAS </option>; 
                      @foreach($cidade as $value)                                                       
                        <option value={{$value->id}}  <?= $value->id == $filtro['cidade_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                      @endforeach   
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationCustom01">Tipologia</label>
                    <select class="input-sm form-control-sm form-control" id="tipologia_id" name="tipologia_id">
                        <option value=0> TODAS </option>;
                        @foreach($tipologia as $value)
                        <option value={{$value->id}}  <?= $value->id == $filtro['tipologia_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        @endforeach
                    </select>
                </div>

                <?php 
                    if( isset(session()->get('obra_filtro')['status_id'])){ 
                        $status = session()->get('obra_filtro')['status_id']; 
                    } else { 
                        $status = 0; 
                    }
                ?>

                <div class="col-md-3 mb-3">
                    <label for="validationCustom01">Status</label>
                    <select class="input-sm form-control-sm form-control" id="status_id" name="status_id">
                      <option value=0> TODAS </option>;
                      <option value=1  <?= $status == 1 ? 'selected' : '' ?> > Em andamento </option>;
                      <option value=2  <?= $status == 2 ? 'selected' : '' ?> > Paralisado </option>;
                      <option value=3  <?= $status == 3 ? 'selected' : '' ?> > Finalizado </option>;
                      <option value=4  <?= $status == 4 ? 'selected' : '' ?> > Entregue </option>;
                    </select>
                </div>

              </div>

            </div>            

        </div>

        <div class="row">
            <div class="col-lg-10">
                <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                <a href="{{url('/obra2/filter_limpar')}}" class="btn btn-warning btn-sm" type="submit">Limpar</a>                
            </div>
        </div>
        </form>

        <br>

        <!-- <div class="table-responsive table-responsive-data2">
        <table class="table table-data2"> -->
        <div class="table-responsive m-b-40 table--no-card m-b-30">
        <table class="table table-borderless table-data3">    
            <thead>
                <tr>
                    <!-- <th>#</th> -->
                    <th>Alerta</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Conclusão</th>
                    <th>Total</th>
                    <th>Executado</th>
                    <th class="text-center">% Execução Financeira</th>
                    <!-- <th>% Execução Física</th> -->
                    <th>Status</th>
                    <th></th>                    
                </tr>
            </thead>
            <tbody>

                @foreach ($obra as $value)
                <tr class="tr-shadow">
                    <!-- <td><p class="text-center">{{$value->id}}</p></td> -->
                    <td> <img src="{{url('img/'.$value->status.'.jpg')}}" class='img-fluid' alt='...'> </td>
                    <td>{{$value->descricao}}</td>
                    <td>
                        <p class="text-center">
                        <?php
                            if($value->dt_inicio == '' or $value->dt_inicio == null){ 
                                echo '-';
                            }else{
                                echo dateBR2($value->dt_inicio);
                            } 
                        ?>
                        </p>
                    </td>
                    <td>
                        <p class="text-center">
                        <?php
                            if($value->dt_conclusao_realizada == '' or $value->dt_conclusao_realizada == null){ 
                                echo '-';
                            }else{
                                echo dateBR2($value->dt_conclusao_realizada);
                            } 
                        ?>
                        </p>
                    </td>
                    <td><p class="text-center">R$ {{$value->valor_total}}</p></td>

                    <?php $v = ($value->valor_total * $value->percentual_execucao_financeira)/100; ?>
                    <td><p class="text-center"><?='R$ '.$v?></p></td>

                    <td><p class="text-center">{{$value->percentual_execucao_financeira}}%</p></td>
                    <!-- <td><p class="text-center">execucao fisica</p></td> -->
                    <td> <span class="status--process">{{ status_fases($value->status_fases) }}</span> </td>
                    <td>
                        <div class="table-data-feature">
                            <a href="{{url('/obra2/'.$value->id.'/view')}}" class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="zmdi zmdi-more"></i>
                            </a>                            
                        </div>
                    </td>

                </tr>
                <tr class="spacer"></tr>
                @endforeach

            </tbody>
        </table>
        </div>

        {{$items->appends([])->links()}}

    </div>
    </div>            
    </div>
    </section>


    <!-- COPYRIGHT-->
    <section class="p-t-60 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <!-- <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COPYRIGHT-->

</div>


<script type="text/javascript">
    
 window.onload = function(){    
    getCidade();
 }

 function getCidade(){
    var url1 = "<?= env('APP_URL'); ?>";
    var regiao_id = document.getElementById("regiao_id").value; 

    var cidade_id = "<?= $filtro['cidade_id']; ?>";

    console.log(cidade_id);   

    $.ajax({
        url: url1+"api/regiao/"+regiao_id+"/cidade",
        method: "post",        
        async: true,
        success: function(objeto){
          var htmlSelect = "";
          htmlSelect+="<option value=0>TODAS</option>";
          for (var i = 0; i < objeto.length; i++) {

              if(objeto[i].id == cidade_id){
                htmlSelect+="<option value="+objeto[i].id+" selected >"+objeto[i].nome+"</option>";
              }else{
                htmlSelect+="<option value="+objeto[i].id+">"+objeto[i].nome+"</option>";                  
              }  
          }
          $("#cidade_id").html(htmlSelect);
        }
    });
 }

</script>


@endsection
