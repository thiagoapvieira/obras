@extends('obras.layout.app')
@section('content')

<?php

  if (isset($obra->dt_atualizacao)){
    $date = date_create($obra->dt_atualizacao);
    $dt_atualizacao = date_format($date,"d/m/Y");
  }else{
    $dt_atualizacao = '';
  }

  if (isset($obra->dt_inicio)){
    $date = date_create($obra->dt_inicio);
    $dt_inicio = date_format($date,"d/m/Y");
  }else{
    $dt_inicio = '';
  }

  if (isset($obra->dt_conclusao_prevista)){
    $date = date_create($obra->dt_conclusao_prevista);
    $dt_conclusao_prevista = date_format($date,"d/m/Y");
  }else{
    $dt_conclusao_prevista = '';
  }

  if (isset($obra->dt_conclusao_realizada)){
    $date = date_create($obra->dt_conclusao_realizada);
    $dt_conclusao_realizada = date_format($date,"d/m/Y");
  }else{
    $dt_conclusao_realizada = '';
  }

  if (isset($obra->dt_assinatura_contrato)){
    $date = date_create($obra->dt_assinatura_contrato);
    $dt_assinatura_contrato = date_format($date,"d/m/Y");
  }else{
    $dt_assinatura_contrato = '';
  }


  if (isset($obra->valor_inicial)){
    //formate para modeda(9.999,99)
    $valor_inicial = number_format($obra->valor_inicial,2,",",".");
  }

  if (isset($obra->valor_investido)){
    //formate para modeda(9.999,99)
    $valor_investido = number_format($obra->valor_investido,2,",",".");
  }

?>


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
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'obra'; ?>
           @include('obras.obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <br>

              <form action="" method="post" novalidate="novalidate">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <label for="descricao" class="control-label mb-1">Descrição da Obra</label>
                      <textarea name="descricao" id="descricao" rows="5" class="form-control"><?= isset($obra->descricao)?$obra->descricao:'' ?></textarea>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                        <label for="prioritaria" class="control-label mb-1">Prioritária</label>
                        <select name="prioritaria" id="prioritaria" class="form-control">
                           <option value="0" <?=isset($obra->prioritaria)? $obra->prioritaria == 0?'selected':'':''?> >Não</option>
                           <option value="1" <?=isset($obra->prioritaria)? $obra->prioritaria == 1?'selected':'':''?> >Sim</option>
                         </select>
                      </div>
                      <div class="col-12 col-md-4">
                        <label for="dt_atualizacao" class="control-label mb-1">Data de atualização</label>
                        <input id="dt_atualizacao" name="dt_atualizacao" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_atualizacao?>">
                      </div>
                      <div class="col-12 col-md-4">
                        <label for="igesp" class="control-label mb-1">IGESP</label>
                        <input id="igesp" name="igesp" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($obra->igesp)?$obra->igesp:'' ?>"> </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                        <label for="setor_id" class="control-label mb-1">Setor</label>
                        <select name="setor_id" id="setor_id" class="form-control">
                           @foreach($setor as $value)
                           <option value={{$value->id}}
                             <?=isset($obra->setor_id)?$value->id==$obra->setor_id?'selected':'' :''?> >{{$value->nome}}
                           </option>;
                           @endforeach
                        </select>
                      </div>
                      <div class="col-12 col-md-4">
                        <label for="modalidade_id" class="control-label mb-1">Modalidade</label>
                        <select name="modalidade_id" id="modalidade_id" class="form-control">
                           @foreach($modalidade as $value)
                           <option value={{$value->id}}
                             <?=isset($obra->modalidade_id)?$value->id==$obra->modalidade_id?'selected':'' :''?> >{{$value->nome}}
                           </option>;
                           @endforeach
                        </select>
                      </div>
                      <div class="col-12 col-md-4">
                        <label for="tipologia_id" class="control-label mb-1">Tipologia</label>
                        <select name="tipologia_id" id="tipologia_id" class="form-control" required>
                            @foreach($tipologia as $value)
                            <option value={{$value->id}}
                              <?= isset($obra->tipologia_id)? $value->id == $obra->tipologia_id ? 'selected' : ''  :''; ?> > {{$value->nome}}
                            </option>;
                            @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                        <label for="projeto_id" class="control-label mb-1">Projeto</label>
                        <select name="projeto_id" id="projeto_id" class="form-control" required>
                            <option value="0"> - </option>
                            @foreach($projeto as $value)
                            <option value={{$value->id}}
                              <?= isset($obra->projeto_id)? $value->id == $obra->projeto_id ? 'selected' : ''  :''; ?> > {{$value->nome}}
                            </option>;
                            @endforeach
                        </select>
                      </div>
                  </div>

                  <br>
                  <hr style="background-color: #ccc;">
                  <br>


                  <div id="teste"></div>

                      <div class="row form-group">
                        <div class="col-12 col-md-7">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="novo_valor()">
                            <i class="fa fa-plus"></i>&nbsp; Novo
                          </button>
                          <br><br>

                          <div class="table-responsive m-b-40">
                          <table class="table table-borderless table-data3">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Fonte de recurso</th>
                                      <th>Valor</th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody id="tabela_obra_valor"></tbody>
                          </table>
                        </div>

                        <div>
                        <b>Valor total</b>
                        <input id="valor_total" name="valor_total" type="text" class="form-control" aria-required="true" aria-invalid="false" value="0" disabled="">
                        </div>
                      </div>

                      <div class="col-12 col-md-3 offset-md-1">
                          <div class="row form-group">
                              <label for="percentual_execucao_financeira" class="control-label mb-1">Percentual de Execução Financeira (%)</label>
                              <input id="percentual_execucao_financeira" name="percentual_execucao_financeira" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($obra->percentual_execucao_financeira)?$obra->percentual_execucao_financeira:'0' ?>">
                          </div>

                          <!--
                          <div class="row form-group">
                              <label for="valor_total" class="control-label mb-1">Valor total</label>
                              <input id="valor_total" name="valor_total" type="text" class="form-control" aria-required="true" aria-invalid="false" value="0" disabled="">
                          </div>
                          -->

                          <div class="row form-group">
                              <label for="valor_executado" class="control-label mb-1">Valor executado</label>
                              <input id="valor_executado" name="valor_executado" type="text" class="form-control" aria-required="true" aria-invalid="false" value="R$ 0" disabled>
                          </div>

                          <div class="row form-group">
                            <label for="valor_a_faturar" class="control-label mb-1">Valor a faturar</label>
                            <input id="valor_a_faturar" name="valor_a_faturar" type="text" class="form-control" aria-required="true" aria-invalid="false" value="R$ 0" disabled>
                          </div>

                          {{-- <div class="row form-group">
                              <label for="valor_a_executar" class="control-label mb-1">Valor a executar</label>
                              <input id="valor_a_executar" name="valor_a_executar" type="text" class="form-control" aria-required="true" aria-invalid="false" value="R$ 0" disabled="">
                          </div> --}}

                          <hr>

                          <div class="row form-group">
                            <label for="percentual_pagamento" class="control-label mb-1">Percentual de Pagamento (%)</label>
                            <input id="percentual_pagamento" name="percentual_pagamento" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($obra->percentual_pagamento)?$obra->percentual_pagamento:'0' ?>">
                          </div>

                          <div class="row form-group">
                            <label for="valor_pago" class="control-label mb-1">Valor Pago</label>
                            <input id="valor_pago" name="valor_pago" type="text" class="form-control" aria-required="true" aria-invalid="false" value="R$ 0" disabled="">
                          </div>

                          <div class="row form-group">
                            <label for="valor_a_pagar" class="control-label mb-1">Valor à Pagar</label>
                            <input id="valor_a_pagar" name="valor_a_pagar" type="text" class="form-control" aria-required="true" aria-invalid="false" value="R$ 0" disabled>
                          </div>
                      </div>
                  </div>


                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                        <label for="status_fases" class="control-label mb-1">Status fases</label>
                        <select name="status_fases" id="status_fases" class="form-control" onchange="box_status_fases()">
                           <option value="0" <?=isset($obra->status_fases)?$obra->status_fases == 0?'selected':'':''?>>Em planejamento</option>
                           <option value="1" <?=isset($obra->status_fases)?$obra->status_fases == 1?'selected':'':''?>>Em licitação</option>
                           <option value="2" <?=isset($obra->status_fases)?$obra->status_fases == 2?'selected':'':''?>>A iniciar</option>
                           <option value="3" <?=isset($obra->status_fases)?$obra->status_fases == 3?'selected':'':''?>>Em execução</option>
                           <option value="4" <?=isset($obra->status_fases)?$obra->status_fases == 4?'selected':'':''?>>Paralisado</option>
                           <option value="5" <?=isset($obra->status_fases)?$obra->status_fases == 5?'selected':'':''?>>Concluído</option>
                           <option value="6" <?=isset($obra->status_fases)?$obra->status_fases == 6?'selected':'':''?>>Cancelada</option>
                         </select>
                      </div>
                      <div id="box_fase_licitacao" class="col-12 col-md-4">
                        <label for="fase_licitacao" class="control-label mb-1">Fase da licitação</label>
                        <select name="fase_licitacao" id="fase_licitacao" class="form-control">
                           @foreach($fase_licitacao as $value)
                           <option value={{$value->id}}
                             <?= isset($obra->fase_licitacao_id)? $value->id == $obra->fase_licitacao_id ? 'selected' : ''  :''; ?> >
                             {{$value->nome}}
                           </option>;
                           @endforeach
                        </select>
                      </div>
                      <div id="box_obra_inaugurada" class="col-12 col-md-4">
                        <label for="inaugurada" class="control-label mb-1">Obra inaugurada? </label>
                        <select name="inaugurada" id="inaugurada" class="form-control" required>
                          <option value="0" <?=isset($obra->inaugurada)?$obra->inaugurada == 0?'selected':'':''?>>Não</option>
                          <option value="1" <?=isset($obra->inaugurada)?$obra->inaugurada == 1?'selected':'':''?>>Sim</option>
                          <option value="2" <?=isset($obra->inaugurada)?$obra->inaugurada == 2?'selected':'':''?>>Não informado</option>
                        </select>
                      </div>
                  </div>
                  <br>


                  <div id="box_cinza" class="row form-group">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="background-color: #ccc;">
                            <div class="row">

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                          <label for="desapropriacao" class="control-label mb-1">Requer <br>desapropriação? </label>
                                          <select name="desapropriacao" id="desapropriacao" class="form-control">
                                            <option value="0" <?=isset($obra->desapropriacao)?$obra->desapropriacao == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->desapropriacao)?$obra->desapropriacao == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->desapropriacao)?$obra->desapropriacao == 2?'selected':'':''?>>Não informado</option>
                                            <option value="3" <?=isset($obra->desapropriacao)?$obra->desapropriacao == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="licenca_ambiental_previa" class="control-label mb-1">Licenca ambiental <br>prévia?</label>
                                          <select name="licenca_ambiental_previa" id="licenca_ambiental_previa" class="form-control">
                                            <option value="0" <?=isset($obra->licenca_ambiental_previa)?$obra->licenca_ambiental_previa == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->licenca_ambiental_previa)?$obra->licenca_ambiental_previa == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->licenca_ambiental_previa)?$obra->licenca_ambiental_previa == 2?'selected':'':''?>>Não informado</option>
                                              <option value="3" <?=isset($obra->licenca_ambiental_previa)?$obra->licenca_ambiental_previa == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="licenca_ambiental_instalacao" class="control-label mb-1">Licenca ambiental de <br>instalação?</label>
                                          <select name="licenca_ambiental_instalacao" id="licenca_ambiental_instalacao" class="form-control">
                                            <option value="0" <?=isset($obra->licenca_ambiental_instalacao)?$obra->licenca_ambiental_instalacao == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->licenca_ambiental_instalacao)?$obra->licenca_ambiental_instalacao == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->licenca_ambiental_instalacao)?$obra->licenca_ambiental_instalacao == 2?'selected':'':''?>>Não informado</option>
                                            <option value="3" <?=isset($obra->licenca_ambiental_instalacao)?$obra->licenca_ambiental_instalacao == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4">
                                          <label for="projeto_basico" class="control-label mb-1">Projeto básico? </label>
                                          <select name="projeto_basico" id="projeto_basico" class="form-control">
                                            <option value="0" <?=isset($obra->projeto_basico)?$obra->projeto_basico == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->projeto_basico)?$obra->projeto_basico == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->projeto_basico)?$obra->projeto_basico == 2?'selected':'':''?>>Não informado</option>
                                            <option value="3" <?=isset($obra->projeto_basico)?$obra->projeto_basico == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="projeto_executivo" class="control-label mb-1">Projeto executivo?</label>
                                          <select name="projeto_executivo" id="projeto_executivo" class="form-control">
                                            <option value="0" <?=isset($obra->projeto_executivo)?$obra->projeto_executivo == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->projeto_executivo)?$obra->projeto_executivo == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->projeto_executivo)?$obra->projeto_executivo == 2?'selected':'':''?>>Não informado</option>
                                            <option value="3" <?=isset($obra->projeto_executivo)?$obra->projeto_executivo == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="titularidade" class="control-label mb-1">Tem titularidade?</label>
                                          <select name="titularidade" id="titularidade" class="form-control">
                                            <option value="0" <?=isset($obra->titularidade)?$obra->titularidade == 0?'selected':'':''?>>Não</option>
                                            <option value="1" <?=isset($obra->titularidade)?$obra->titularidade == 1?'selected':'':''?>>Sim</option>
                                            <option value="2" <?=isset($obra->titularidade)?$obra->titularidade == 2?'selected':'':''?>>Não informado</option>
                                            <option value="3" <?=isset($obra->titularidade)?$obra->titularidade == 3?'selected':'':''?>>Não aplicável</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-12">
                                    <label for="licenca_outros_orgaos" class="control-label mb-1">Licenca de outros <br> orgãos? </label>
                                    <select name="licenca_outros_orgaos" id="licenca_outros_orgaos" class="form-control" onchange="licenca_outros_orgaos1()">
                                        <option value="0" <?=isset($obra->licenca_outros_orgaos)?$obra->licenca_outros_orgaos == 0?'selected':'':''?>>Não</option>
                                        <option value="1" <?=isset($obra->licenca_outros_orgaos)?$obra->licenca_outros_orgaos == 1?'selected':'':''?>>Sim</option>
                                        <option value="2" <?=isset($obra->licenca_outros_orgaos)?$obra->licenca_outros_orgaos == 2?'selected':'':''?>>Não informado</option>
                                        <option value="3" <?=isset($obra->licenca_outros_orgaos)?$obra->licenca_outros_orgaos == 3?'selected':'':''?>>Não aplicável</option>
                                    </select>
                                    </div>
                                    <br>

                                    <div id="box_especifique_orgaos" class="col-md-12">
                                      <label for="especifique_orgaos" class="control-label mb-1">Especifique quais orgãos</label>
                                      <input id="especifique_orgaos" name="especifique_orgaos" type="text" class="form-control" aria-required="true" aria-invalid="false"
                                      value="<?= isset($obra->especifique_orgaos)?$obra->especifique_orgaos:'' ?>">
                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                          <label for="dt_inicio" class="control-label mb-1">Data de início</label>
                          <input id="dt_inicio" name="dt_inicio" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_inicio?>">
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="dt_conclusao_prevista" class="control-label mb-1">Data de conclusão prevista</label>
                          <input id="dt_conclusao_prevista" name="dt_conclusao_prevista" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_conclusao_prevista?>">
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="dt_conclusao_realizada" class="control-label mb-1">Data de conclusão realizada</label>
                          <input id="dt_conclusao_realizada" name="dt_conclusao_realizada" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_conclusao_realizada?>">
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-4">
                          <label for="prazo_entrega" class="control-label mb-1">Prazo entrega (dias)</label>
                          <input id="prazo_entrega" name="prazo_entrega" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($obra->prazo_entrega)?$obra->prazo_entrega:'0' ?>">
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="percentual_execucao_fisica" class="control-label mb-1">Percentual de execução física (%)</label>
                          <input id="percentual_execucao_fisica" name="percentual_execucao_fisica" type="text" class="form-control" aria-required="true" aria-invalid="false"
                          value="<?= isset($obra->percentual_execucao_fisica)?$obra->percentual_execucao_fisica:'0' ?>" pattern="[0-9]+$">
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="dt_assinatura_contrato" class="control-label mb-1">Data de assinatura do contrato</label>
                          <input id="dt_assinatura_contrato" name="dt_assinatura_contrato" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_assinatura_contrato?>">
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                      <label for="obs" class="control-label mb-1">Observações</label>
                      <textarea name="obs" id="obs" rows="5" class="form-control"><?= isset($obra->obs)?$obra->obs:'' ?></textarea>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                      <label for="descricao_estagio" class="control-label mb-1">Detalhar o estágio atual da obra</label>
                      <textarea name="descricao_estagio" id="descricao_estagio" rows="5" class="form-control"><?= isset($obra->descricao_estagio)?$obra->descricao_estagio:'' ?></textarea>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                      <label for="descricao_proxima_fase" class="control-label mb-1">Descrever próxima fase da obra</label>
                      <textarea name="descricao_proxima_fase" id="descricao_proxima_fase" rows="5" class="form-control"><?= isset($obra->descricao_proxima_fase)?$obra->descricao_proxima_fase:'' ?></textarea>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                      <label for="descricao_pendencias_prazo" class="control-label mb-1">Descrever as pendências (se houver) e o prazo estimado para a obra ir para a próxima fase.</label>
                      <textarea name="descricao_pendencias_prazo" id="descricao_pendencias_prazo" rows="5" class="form-control"><?= isset($obra->descricao_pendencias_prazo)?$obra->descricao_pendencias_prazo:'' ?></textarea>
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col-md-4">
                        <label for="status" class="control-label mb-1">Alerta de Status </label>
                        <select name="status" id="status" class="form-control">
                           <option value="0" <?= isset($obra->status)? $obra->status==0?'selected':''  :''; ?>>Ruim</option>
                           <option value="1" <?= isset($obra->status)? $obra->status==1?'selected':''  :''; ?>>Regular</option>
                           <option value="2" <?= isset($obra->status)? $obra->status==2?'selected':''  :''; ?>>Bom</option>
                           <option value="3" <?= isset($obra->status)? $obra->status==3?'selected':''  :''; ?>>Não informado</option>
                        </select>
                      </div>
                  </div>
                  <br>


                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{url('obras/obra')}}" class="btn btn-danger">Voltar</a>
                  </div>

              </form>
        		</div>


        </div>
        </div>
    </div>
    </section>

</div>



@include('obras.obra.obra_modal_valor');


<script language="javascript">

var obra_id = <?= isset($obra->id) ? $obra->id : 0; ?>;

window.onload = function(){
  box_status_fases();
  licenca_outros_orgaos1();
  liste_obra_valor();
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


function licenca_outros_orgaos1(){
  var e = document.getElementById("licenca_outros_orgaos");
  var id = e.options[e.selectedIndex].value;

  if(id == 1){
    document.getElementById("box_especifique_orgaos").style.display = 'block';
  }else{
    document.getElementById("box_especifique_orgaos").style.display = 'none';
  }
}


function liste_obra_valor(){
    $.ajax({
        url: url1+"api/obras/obra/"+obra_id+"/valor/lista",
        method: "get",
        async: false  ,
        success: function(objeto){
          var htmlSelect = "";
          var soma = 0;
          var perc = 0;
          var perc2 = 0;
          var valor_pago = 0;
          var valor_a_pagar = 0;

          for (i = 0; i < objeto.length; i++){
            soma = parseFloat(soma) + parseFloat(objeto[i].valor);
            htmlSelect += "<tr>";
            htmlSelect += "<td>"+objeto[i].id+"</td>";
            htmlSelect += "<td>"+objeto[i].fonte+"</td>";
            htmlSelect += "<td>"+parseFloat(objeto[i].valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })+"</td>";
            htmlSelect += "<td>";
              htmlSelect += "<button onclick='editar_valor("+objeto[i].id+")' type='button' class='item' data-toggle='modal' data-target='#exampleModal' data-toggle='tooltip' data-placement='top' title='Editar'>";
              htmlSelect += "<i class='zmdi zmdi-edit'></i>";
              htmlSelect += "</button>";
            htmlSelect += "</td>";
            htmlSelect += "<td>";
              htmlSelect += "<button onclick='delete_valor("+objeto[i].id+")' type='button' class='item' data-toggle='tooltip' data-placement='top' title='Excluir'>";
              htmlSelect += "<i class='zmdi zmdi-delete'></i>";
              htmlSelect += "</button>";
            htmlSelect += "</td>";
            htmlSelect += "</tr>";
          }

          perc = $("#percentual_execucao_financeira").val();
          execultado =  parseFloat( ((soma * perc)/100).toFixed(2) );
          valor_a_faturar = parseFloat( (soma - execultado).toFixed(2) );

          perc2 = $("#percentual_pagamento").val();
          valor_pago =  parseFloat( ((soma * perc2)/100).toFixed(2) );
          valor_a_pagar = parseFloat( (soma - valor_pago).toFixed(2) );

          // executar = parseFloat( (soma - execultado).toFixed(2) );

          var soma = soma.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
          var execultado = execultado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
          var valor_a_faturar = valor_a_faturar.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

          var valor_pago = valor_pago.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
          var valor_a_pagar = valor_a_pagar.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

          // var executar = executar.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
          // executar = formatarMoeda(executar);

          $("#tabela_obra_valor").html(htmlSelect);
          $("#valor_total").val(soma);
          $("#valor_executado").val(execultado);
          $("#valor_a_faturar").val(valor_a_faturar);
          $("#valor_pago").val(valor_pago);
          $("#valor_a_pagar").val(valor_a_pagar);
        }
    });
}


function novo_valor(){
  $("#valor_id").val(0);
  $("#valor_id_obra").val('');
  $("#fonte").val('');
  $("#valor").val('');
}


function editar_valor(id){
    $.ajax({
        url: url1+"api/obras/obra/"+obra_id+"/valor/"+id,
        method: "get",
        async: false  ,
        success: function(objeto){
          $("#valor_id").val(objeto[0].id);
          $("#valor_id_obra").val(objeto[0].obra_id);
          $("#fonte").val(objeto[0].fonte);
          $("#valor").val(objeto[0].valor);
        }
    });
}

function delete_valor(id){
    $.ajax({
        url: url1+"api/obras/obra/"+obra_id+"/valor/"+id+"/delete",
        method: "post",
        async: false  ,
        success: function(objeto){
          $("#valor_id").val(objeto[0].id);
          $("#valor_id_obra").val(objeto[0].obra_id);
          $("#fonte").val(objeto[0].fonte);
          $("#valor").val(objeto[0].valor);

          liste_obra_valor();
        }
    });
}


</script>

@endsection
