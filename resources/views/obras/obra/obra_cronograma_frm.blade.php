@extends('obras.layout.app')
@section('content')

<?php
  
  if (isset($obra_cronograma->dt_inicio)){
    $date = date_create($obra_cronograma->dt_inicio);                      
    $dt_inicio = date_format($date,"d/m/Y");    
  }else{
    $dt_inicio = '';    
  }

  if (isset($obra_cronograma->dt_termino)){
    $date = date_create($obra_cronograma->dt_termino);                      
    $dt_termino = date_format($date,"d/m/Y");    
  }else{
    $dt_termino = '';    
  }

?>


<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 offset-md-3"> 

          @if (session('msg'))
          <div class="alert alert-success"> {{ session('msg') }} </div>
          @endif                  

          <h3> <?= $id == 0?'Inserir Cronograma':'Editar Cronograma'; ?>  </h3>
          <br>

          <?php if($id == 0){ ?>
        	<form method="post" action="{{url('obras/obra/'.$obra_id.'/cronograma/novo')}}" >
          <?php }else{ ?>
          <form method="post" action="{{url('obras/obra/'.$obra_id.'/cronograma/'.$id.'/editar')}}" >            
          <?php } ?>          

          {{ csrf_field() }}
            <div class="row form-group">
              <div class="col-12 col-md-2">
                <label for="pos" class="control-label mb-1">Nº</label>
                <input id="pos" name="pos" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($obra_cronograma->pos)?$obra_cronograma->pos:'' ?>"> 
              </div>  
              <div class="col-12 col-md-10">
                <label for="atividade" class="control-label mb-1">Atividade</label>
                <input id="atividade" name="atividade" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($obra_cronograma->atividade)?$obra_cronograma->atividade:'' ?>"> 
              </div>  
            </div>            
            <div class="form-group">
                <label for="responsavel" class="control-label mb-1">Responsável</label>
                <input id="responsavel" name="responsavel" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($obra_cronograma->responsavel)?$obra_cronograma->responsavel:'' ?>"> 
            </div>
            <div class="row form-group">
              <div class="col-12 col-md-6">
                <label for="dt_inicio" class="control-label mb-1">Data de início</label>
                <input id="dt_inicio" name="dt_inicio" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($dt_inicio)?$dt_inicio:'' ?>"> 
              </div>  
              <div class="col-12 col-md-6">
                <label for="dt_termino" class="control-label mb-1">Data de término</label>
                <input id="dt_termino" name="dt_termino" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($dt_termino)?$dt_termino:'' ?>"> 
              </div>  
            </div>            
            <div class="row form-group">
              <div class="col-12 col-md-8">
                <label for="prazo" class="control-label mb-1">Prazo</label>
                <input id="prazo" name="prazo" type="text" class="form-control" aria-required="true" 
                aria-invalid="false" value="<?= isset($obra_cronograma->prazo)?$obra_cronograma->prazo:'' ?>"> 
              </div>  
              <div class="col-12 col-md-4">
                <label for="status_id" class="control-label mb-1">Status</label>
                <select name="status_id" id="status_id" class="form-control">
                  <option value="0" <?=isset($obra_cronograma->status_id)? $obra_cronograma->status_id == 0?'selected':'':''?> >A iniciar</option>
                  <option value="1" <?=isset($obra_cronograma->status_id)? $obra_cronograma->status_id == 1?'selected':'':''?> >Em Andamento</option> 
                  <option value="2" <?=isset($obra_cronograma->status_id)? $obra_cronograma->status_id == 2?'selected':'':''?> >Atrasado</option> 
                  <option value="3" <?=isset($obra_cronograma->status_id)? $obra_cronograma->status_id == 3?'selected':'':''?> >Concluído</option> 
                </select>
              </div>  
            </div>  

            <br>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="{{url('obras/obra/'.$obra_id.'/cronograma')}}" class="btn btn-danger">Voltar</a>
            </div>

          </form>        

        </div>
        </div>
    </div>
    </section>

</div>




@endsection
