@extends('obras.layout.app')
@section('content')

<div class="page-content--bgf7">

    <!-- DATA TABLE-->
    <section class="p-t-20">
    <div class="container">
    <div class="row">
    <div class="col-md-12" >
                        
        <br>
        <div class="row">
            <div class="col-md-9" >
                <h2 class="title-5 m-b-35 titulo">
                    {{$obra->descricao}}<br>
                    <?php if($obra->updated_at <> null or $obra->updated_at <> ''){ ?>
                    <!-- <span style="color: #383838; font-size: 10px;"> Última atualização por {{usuario_nome($obra->updated_at_user)}}: {{dateBR($obra->updated_at)}} </span> -->
                    <span style="color: #383838; font-size: 10px;"> Última atualização: {{dateBR($obra->updated_at)}} </span>
                    <?php } ?>
                </h2>               

                <div class="row">
                    <div class="col-md-1"> 
                        <img src="{{url('img/'.$obra->status.'.jpg')}}" class='img-fluid' alt='...' width="40px">
                    </div>
                    <div class="col-md-4"> 
                        Percentual de execução física<br>  
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{$obra->percentual_execucao_fisica}}%;" aria-valuenow="20" 
                          aria-valuemin="0" aria-valuemax="100"> {{$obra->percentual_execucao_fisica}}%</div>
                        </div>
                    </div>    
                </div>
                <br>        

                <div class="row">
                    <div class="col-md-4"> 
                        <span class="titulo">Obra prioritára:</span> <?= $obra->prioritaria==1?' Sim':' Não'?> 
                    </div>
                    <div class="col-md-4"> 
                        <span class="titulo">Status fases:</span> {{status_fases($obra->status_fases)}}
                    </div>

                    <?php if ($obra->status_fases == 5){ //se status_fases for 'concluido' entao aparece ?> 
                    <div class="col-md-4"> 
                        <span class="titulo">Inaugurada:</span> <?= $obra->inaugurada==1?' Sim':' Não'?>
                    </div>
                <?php } ?>
                </div>    
                <br>

                <div class="row">
                    <div class="col-md-4"> 
                        <span class="titulo">Setor:</span> {{$setor}}
                    </div>
                    <div class="col-md-4"> 
                        <span class="titulo">Modalidade:</span> {{$modalidade}}
                    </div>
                    <div class="col-md-4"> 
                        <span class="titulo">Tipologia:</span> {{$tipologia}}
                    </div>
                </div>    
                <br>

                <div class="row">
                    <div class="col-md-12"> <span class="titulo">Municípios:</span> {{$cidades}} </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12"> <span class="titulo">Secretaria/ Órgão principal:</span> {{$orgao_principal}} </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12"> 
                        <span class="titulo">Secretaria/Órgãos envolvidos:</span> 
                            {{$orgaos}} 
                    </div> 
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-6"><span class="titulo">Data de assinatura do contrato:</span> {{dateBR2($obra->dt_assinatura_contrato)}} </div>
                    <div class="col-md-6"><span class="titulo"> Data de início:</span> {{dateBR2($obra->dt_inicio)}} </p></div>
                </div>
                <br>
                    
                <div class="row">                    
                    <div class="col-md-6"><span class="titulo">Data de conclusão prevista:</span> 
                        {{dateBR2($obra->dt_conclusao_prevista)}}  
                    </div>
                    <div class="col-md-6"><span class="titulo">Data de conclusão realizada:</span> 
                        {{dateBR2($obra->dt_conclusao_realizada)}}
                    </div>
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-6"><span class="titulo">Prazo de entrega:</span> {{$obra->prazo_entrega}}  </div>
                    <div class="col-md-6"><span class="titulo">Percentual de execução física:</span> {{$obra->percentual_execucao_fisica}} </div>
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-4"> <span class="titulo">Valor total</span> <br>{{number_format($valor_total,2,",",".")}} </div>
                    <div class="col-md-4"> <span class="titulo">Valor executado</span> <br>{{number_format($valor_executado,2,",",".")}} </div>
                    <div class="col-md-4"> <span class="titulo">Valor a executar</span> <br>{{number_format($valor_a_executar,2,",",".")}} </div>
                </div>
                <br>     

                <div class="row">                    
                    <div class="col-md-6"> <span class="titulo">Percentual de execução financeira:</span> 
                    {{$obra->percentual_execucao_financeira}}%</div>
                    <div class="col-md-6"> <span class="titulo">Percentual de execução física:</span> 
                    {{$obra->percentual_execucao_fisica}}%</div>
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-12"> 
                        
                        <div class="table-responsive m-b-40 table--no-card m-b-30">
                        <table class="table table-borderless table-striped" style="background-color: #ccc;">
                        <thead>
                            <tr>
                                <th>fonte de recurso</th>
                                <th class="text-right">valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obra_valor as $value)
                            <tr>
                                <td>{{$value->fonte}}</td>
                                <td class="text-right">R$ {{number_format($value->valor,2,",",".")}}</td>
                            </tr>
                            @endforeach   
                        </tbody>
                        </table>
                        </div>

                    </div>
                </div>    
                

                <div class="row">                    
                    <?php if ($obra->status_fases == 1){ ?>
                    <div class="col-md-4"> <span class="titulo">Fase da licitação: </span> 
                        {{$obra->fase_licitacao}} 
                    </div>
                    <?php } ?>
                </div>
                <br>    

                <?php if ($obra->status_fases < 3){ //se status_fases for menor a 'execucao em diante' parace  ?> 
                <div class="row">                    

                    <div class="col-md-4"> <span class="titulo">Requer desapropriação? </span>
                        <br> <?= caixa_cinza($obra->desapropriacao) ?>                        
                    </div>
                    <div class="col-md-4"> <span class="titulo">Licenca ambiental prévia?</span>
                        <br> <?= caixa_cinza($obra->licenca_ambiental_previa)?>
                    </div>
                    <div class="col-md-4"> <span class="titulo">Licenca ambiental de instalação?</span>
                        <br> <?= caixa_cinza($obra->licenca_ambiental_instalacao)?>
                    </div>
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-3"> <span class="titulo">Licenca de outros orgãos? </span>
                        <br> <?= caixa_cinza($obra->licenca_outros_orgaos)?>
                        <?php 
                            if($obra->licenca_outros_orgaos == 1){
                              echo $obra->especifique_orgaos;
                            }
                        ?>
                    </div>
                    <div class="col-md-3"> <span class="titulo">Projeto básico? </span>

                        <br> <?= caixa_cinza($obra->projeto_basico)?>
                    </div>
                    <div class="col-md-3"> <span class="titulo">Projeto executivo? </span>
                        <br> <?= caixa_cinza($obra->projeto_executivo)?>
                    </div>
                    <div class="col-md-3"> <span class="titulo">Tem titularidade? </span>
                        <br> <?= caixa_cinza($obra->titularidade)?>
                    </div>
                </div>
                <br>
            <?php }?>


                <div class="row">                    
                    <div class="col-md-12">
                        <span class="titulo">Observações:</span>
                        {{$obra->obs}}
                    </div>
                </div>
                <br>

                <div class="row">                    
                    <div class="col-md-12"><span class="titulo">Detalhar o estágio atual da obra:</span>
                        {{$obra->descricao_estagio}}
                    </div>
                </div> 
                <br>

                <div class="row">                    
                    <div class="col-md-12"><span class="titulo">Descrever próxima fase da obra:</span>
                        {{$obra->descricao_proxima_fase}}
                    </div>
                </div> 
                <br>

                <div class="row">                    
                    <div class="col-md-12"><span class="titulo">Descrever as pendências (se houver) e o prazo estimado para a obra ir para a próxima fase:</span>
                        {{$obra->descricao_pendencias_prazo}}
                    </div>
                </div>
                <br>

                <div class="row"> 
                    <div class="col-md-12"> 
                    <span class="titulo">Cronograma</span>
                        
                        <div class="table-responsive m-b-40 table--no-card m-b-30">
                        <table class="table table-borderless table-striped" style="background-color: #ccc;">
                        <thead>
                            <tr>                                
                                <th>Nº</th>
                                <th>Atividade</th>
                                <th>Responsável</th>
                                <th>Início</th>
                                <th>Término</th>
                                <th>Prazo</th>
                                <th>Status</th>                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cronograma as $value)
                            <tr>                                
                                <td>{{$value->pos}}</td>
                                <td>{{$value->atividade}}</td>
                                <td>{{$value->responsavel}}</td>
                                <td>{{dateBR2($value->dt_inicio)}}</td>
                                <td>{{dateBR2($value->dt_termino)}}</td>
                                <td>{{$value->prazo}}</td>
                                <td>{{statusCronograma($value->status_id)}}</td>                        
                            </tr>
                            @endforeach   
                        </tbody>
                        </table>
                        </div>

                    </div>
                </div>

                <div class="row"> 
                    <div class="col-md-12"> 
                    <span class="titulo">Anexos</span>
                    <br>
                        
                        <div class="table-responsive m-b-40 table--no-card m-b-30">
                        <table class="table table-borderless table-striped" style="background-color: #ccc;">
                        <thead>
                            <tr>
                                <th>Arquivo</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anexo as $value)
                            <tr>
                                <td>
                                <a href="{{env('APP_URL').'/uploads/anexo/'.$value->id.'/'.$value->filename}}">
                                    {{$value->descricao}}
                                </a>
                                </td>
                            </tr>
                            @endforeach   
                        </tbody>
                        </table>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-3" >

                <a href="{{url('obras/obra/'.$obra->id.'/historico')}}" class="btn btn-info btn-sm" type="submit">Histórico</a>

                @foreach ($imagem as $value)
                <img src="{{env('APP_URL').'/uploads/imagem/'.$value->id.'/'.$value->filename}}" class="rounded img-fluid">
                <br>
                <br>
                @endforeach
            </div>            
        </div>     





        
    </div>

</div>


<script type="text/javascript">
    window.onload = function(){
     
    }


    function box_status_fases(){
      var e = document.getElementById("status_fases");
      var status_id = e.options[e.selectedIndex].value;  

      // se o status for 'Em licitação' entao aparece 'Fase da licitação'  
      if(status_id == 1){
        document.getElementById("box_fase_licitacao").style.display = 'block';
      }else{
        document.getElementById("box_fase_licitacao").style.display = 'none';    
      }

      if(status_id == 5){
        document.getElementById("box_obra_inaugurada").style.display = 'block';
      }else{
        document.getElementById("box_obra_inaugurada").style.display = 'none';    
      }

      if(status_id < 3){
        document.getElementById("box_cinza").style.display = 'block';
      }else{
        document.getElementById("box_cinza").style.display = 'none';    
      }
    }
</script>


@endsection
