@extends('obras.layout.app')
@section('content')

<div class="page-content--bgf7">

    <!-- DATA TABLE-->
    <section class="p-t-20">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12" >
                    
        <div class="row">            
            <div class="col-lg-11">
                <h2 class="title-5 m-b-35">Obras</h2>
            </div>    
            <div class="col-lg-1 text-right">
                <a href="{{url('obras/obra/novo')}}" class="btn btn-success btn-sm" type="submit">Novo</a>
            </div>
        </div>

        <form role="form" action="" method="post"> 
        {{ csrf_field() }}  
        <div class="row">
            
            <div class="col-lg-12">

              <div class="form-row">
                <div class="col-md-1 mb-3">
                  <label for="codigo">Código</label>
                  <input type="text" class="input-sm form-control-sm form-control" id="codigo" name="codigo" placeholder="" value="{{session()->get('obra_filtro')['codigo']}}"> 
                </div>
                <div class="col-md-3 mb-3">
                  <label for="descricao">Descricão</label>
                  <input type="text" class="input-sm form-control-sm form-control" id="descricao" name="descricao" placeholder="" value="{{session()->get('obra_filtro')['descricao']}}"> 
                </div>
                <div class="col-md-3 mb-3">
                  <label for="fonte">Fonte</label>
                  <input type="text" class="input-sm form-control-sm form-control" id="fonte" name="fonte" placeholder="" value="{{session()->get('obra_filtro')['fonte']}}"> 
                </div>
                <div class="col-md-2 mb-3">
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
                <div class="col-md-2 mb-3">
                  <label for="dt_conclusao_realizada">Fim</label>
                  <input id="dt_conclusao_realizada" name="dt_conclusao_realizada" type="text" class="input-sm form-control-sm form-control" aria-required="true" aria-invalid="false" value="<?= $dt_conclusao_realizada?>">
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Territórios</label>
                    <select class="input-sm form-control-sm form-control" id="regiao_id" name="regiao_id" onchange="getCidade()">
                        <option value=0> TODOS </option>;
                        @foreach($regiao as $value)
                        <option value={{$value->id}} <?= $value->id == $filtro['regiao_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Cidade</label>
                    <select class="input-sm form-control-sm form-control" id="cidade_id" name="cidade_id">
                      <option value=0> TODAS </option>; 
                      @foreach($cidade as $value)                                                       
                        <option value={{$value->id}}  <?= $value->id == $filtro['cidade_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                      @endforeach   
                    </select>
                </div>

                <div class="col-md-2 mb-3">
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

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Status</label>
                    <select class="input-sm form-control-sm form-control" id="status_id" name="status_id">
                      <option value=-1> TODOS </option>;
                      <option value="0" <?=$status == 0?'selected':''?>>Em planejamento</option>
                      <option value="1" <?=$status == 1?'selected':''?>>Em licitação</option>
                      <option value="2" <?=$status == 2?'selected':''?>>A iniciar</option>
                      <option value="3" <?=$status == 3?'selected':''?>>Em execução</option>
                      <option value="4" <?=$status == 4?'selected':''?>>Paralisado</option>
                      <option value="5" <?=$status == 5?'selected':''?>>Concluído</option>
                      <option value="6" <?=$status == 6?'selected':''?>>Cancelado</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Setor</label>
                    <select class="input-sm form-control-sm form-control" id="setor_id" name="setor_id">
                        <option value=0> TODOS </option>;
                        @foreach($setor as $value)
                        <option value={{$value->id}}  <?= $value->id == $filtro['setor_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Modalidade</label>
                    <select class="input-sm form-control-sm form-control" id="modalidade_id" name="modalidade_id">
                        <option value=0> TODAS </option>;
                        @foreach($modalidade as $value)
                        <option value={{$value->id}}  <?= $value->id == $filtro['modalidade_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Orgão</label>
                    <select class="input-sm form-control-sm form-control" id="orgao_id" name="orgao_id">
                      <option value=0> TODOS </option>; 
                      @foreach($orgao as $value)
                        <?php if($value->id <> 0){ ?>                                                       
                        <option value={{$value->id}}  <?= $value->id == $filtro['orgao_id'] ? 'selected' : '' ?> > {{$value->sigla}} - {{$value->nome}} </option>;
                        <?php } ?>
                      @endforeach   
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="validationCustom01">Projeto</label>
                    <select class="input-sm form-control-sm form-control" id="projeto_id" name="projeto_id">
                      <option value=0> TODOS </option>;
                      @foreach($projeto as $value)
                        <?php if($value->id <> 0){ ?>                                                       
                        <option value={{$value->id}}  <?= $value->id == $filtro['projeto_id'] ? 'selected' : '' ?> > {{$value->nome}} </option>;
                        <?php } ?>
                      @endforeach   
                    </select>
                </div>

              </div>

            </div>            

        </div>

        <div class="row">
            <div class="col-lg-10">
                <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                <a href="{{url('obras/obra/filter_limpar')}}" class="btn btn-warning btn-sm" type="submit">Limpar</a>  
                <!-- <button class="btn btn-info btn-sm" type="submit" id="pdf" name="pdf" value="1">Imprimir</button> -->
                <button class="btn btn-secondary btn-sm" type="submit" id="excel" name="excel" value="1">Excel</button>              
            </div>
        </div>
        </form>

        <br>

        <div class="row" style="margin-bottom: 10px;">            
            <div class="col-md-12">
                <p class="text-right"> Total de registro encontrados: {{$numero_registro}} </p>
            </div>
        </div>              

        <!-- <div class="table-responsive table-responsive-data2">
        <table class="table table-data2"> -->
        <div class="table-responsive m-b-40 table--no-card m-b-30">
        <table class="table table-borderless table-data3">    
            <thead>
                <tr>
                    <th>Código</th>
                    <!-- <th>P</th> -->
                    <th>Alerta</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <!-- <th>Conclusão</th> -->
                    <th>Total</th>
                    <!-- <th>Executado</th> -->
                    <th class="text-center">% Execução financeira</th>
                    <th class="text-center">% Execução física</th>
                    <!-- <th>% Execução Física</th> -->
                    <th>Status fase</th>
                    <th></th>                    
                </tr>
            </thead>
            <tbody>

                @foreach ($obra as $value)
                <tr class="tr-shadow">
                    <td><p class="text-center">{{$value->id}}</p></td>
                    <!-- <td><p class="text-center">{{$value->prioritaria}}</p></td> -->
                    <td> <img src="{{url('img/'.$value->status.'.jpg')}}" class='img-fluid' alt='...' width="40px"> </td>
                    <td>
                        <a href="{{url('obras/obra/'.$value->id.'/view')}}"> {{$value->descricao}} </a>
                    </td>
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
                    <!--
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
                    -->
                    <td><p class="text-center">R$ {{number_format($value->valor_total,2,",",".")}}</p></td>

                    <?php $v = ($value->valor_total * $value->percentual_execucao_financeira)/100; ?>
                    <!--<td><p class="text-center"><?='R$ '.number_format($v,2,",",".")?></p></td>-->

                    <td><p class="text-center">{{$value->percentual_execucao_financeira}}%</p></td>
                    <td><p class="text-center">{{$value->percentual_execucao_fisica}}%</p></td>
                    <!-- <td><p class="text-center">execucao fisica</p></td> -->
                    <td> <span class="status--process">{{ status_fases($value->status_fases) }}</span> </td>
                    <td>
                        <div class="table-data-feature">
                            <a href="{{url('obras/obra/'.$value->id.'/view')}}" class="item" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="zmdi zmdi-more"></i>
                            </a>
                            <a href="{{url('obras/obra/'.$value->id.'/editar')}}" class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a href="{{url('obras/obra/'.$value->id.'/excluir')}}" class="item" data-toggle="tooltip" data-placement="top" title="Excluir" onClick="return confirm('Deseja realmente excluir')">
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

        <div class="row">
            <div class="col-md-6">
                {{$items->appends([])->links()}}
            </div> 
            <div class="col-md-6">
                <p class="text-right"> Total de registro encontrados: {{$numero_registro}} </p>
            </div>
        </div>        

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