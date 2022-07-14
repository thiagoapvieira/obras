<template>
<section class="p-t-20">

<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">

    <!-- perspectiva -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="title-5 m-b-35">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_per" v-on:click.prevent="set_perspectiva(0, null)">
                    <i class="fas fa-plus"></i>
                </button>
                Perspectiva
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">

                    <div class="form-row">
                        <div class="col-md-1 mb-3">
                            <label for="nivel_pesq">nível</label>
                            <!-- <input type="text" class="input-sm form-control-sm form-control" v-model="nivel_pesq" value="ind"> -->
                            <select class="form-control-sm form-control" v-model="nivel_pesq">
                                <option value="ind">Indicador</option>
                                <option value="est">Estrutura</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="descricao">Descricão</label>
                            <input type="text" class="input-sm form-control-sm form-control" v-model="descricao"  placeholder="">
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <button class="btn btn-primary btn-sm" v-on:click.prevent="consulta()">Filtrar</button>
                    <button class="btn btn-warning btn-sm" @click="limpar()">Limpar</button>
                </div>
            </div>

        </div>
    </div>
    <br>


    <div class="row" v-if="caixa_load">
        <div class="col-md-4 offset-4">
            <div class="alert alert-info text-center" role="alert">
                Carregando ...
            </div>
        </div>
    <br>
    </div>


    <div class="row mb-2">
        <div class="col-sm-12">

            <div class="card" v-for="(p, key) of perspectiva">
                <div class="card-header">
                    <strong class="card-title">

                        <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">

                            <!-- edite perspectiva -->
                            <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_per"
                            v-on:click.prevent="set_perspectiva(p.id, p.nome)">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>

                            <!-- delete perspectiva -->
                            <button class="btn btn-outline-danger" v-on:click.prevent="delete_perspectiva(p.id)">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- inserir objetivo -->
                            <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_obj"
                            v-on:click.prevent="set_objetivo(0, p.id, '')">
                                <i class="fas fa-plus"></i>
                            </a>

                        </div>

                        {{p.nome}}

                    </strong>
                </div>
                <div class="card-body" v-for="(n, key2) of perspectiva[key].objeto">

                        <!-- objetivos -->
                        <div style="margin-bottom: 15px;">
                            <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">

                                <!-- edite objetivo -->
                                <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_obj"
                                   v-on:click.prevent="set_objetivo(n.id, n.per_id, n.nome)">
                                   <i class="fas fa-pencil-square-o"></i>
                                </a>

                                <!-- delete objetivo -->
                                <button class="btn btn-outline-danger" v-on:click.prevent="delete_objetivo(n.id)">
                                <i class="fas fa-trash"></i>
                                </button>

                                <!-- insert estrategia -->
                                <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_est"
                                   v-on:click.prevent="set_estrategia(0, n.id, '')">
                                   <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <b> {{n.nome}} </b>
                        </div>

                        <!-- Estrategia -->
                        <div style="margin-left: 15px; margin-bottom: 10px;" v-for="(e,key3) of perspectiva[key].objeto[key2].estrategia">
                            <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">

                                <!-- edite estrategia -->
                                <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_est"
                                   v-on:click.prevent="set_estrategia(e.id, e.obj_id, e.nome)">
                                   <i class="fas fa-pencil-square-o"></i>
                                </a>

                                <!-- delete estrategia -->
                                <button class="btn btn-outline-danger" v-on:click.prevent="delete_estrategia(e.id)">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- insert indicador -->
                                <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_ind"
                                   v-on:click.prevent="set_indicador(0,e.id)">
                                   <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            #{{e.id}} - {{e.nome}}

                            <!-- indicadores -->
                            <div class="indicadores" style="margin: 10px 0 10px 30px;">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>name</th>
                                            <th>meta agregada</th>
                                            <th>realizado acumulado</th>
                                            <th>Execução agregada</th>
                                            <th>Status</th>
                                            <th>Responsável</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="tr-shadow" v-for="ind of perspectiva[key].objeto[key2].estrategia[key3].indicador" v-on:click.prevent="set_indicador(ind.id,e.id)">
                                            <td> {{ind.id}} </td>
                                            <td> <a href="#" data-toggle="modal" data-target="#modal_ind"> {{ind.nome}} </a> </td>
                                            <td>{{ind.meta_agregada}}</td>
                                            <td>{{ind.realizado_acumulado}}</td>
                                            <td>{{ind.execucao_agregada}}</td>
                                            <td>{{ind.status}}</td>
                                            <td>{{ind.responsavel}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">

                                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_ind">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                    </button>

                                                    <button class="btn btn-outline-danger btn-sm" v-on:click.prevent="delete_indicador(ind.id)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                </div>
            </div>

        </div>
    </div>

</div>
</div>
</div>

<!-- Modal Perspectiva -->
<div class="modal fade bd-example-modal-lg" id="modal_per" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo/Editar Perspectiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12 espaco1">
            <div class="form-group">
                <label for="exampleInputEmail1">Título</label>
                <input type="text" v-model="perspectiva_nome" class="form-control form-control-sm">
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" v-on:click.prevent="save_perspectiva()">Salvar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Objetivo -->
<div class="modal fade bd-example-modal-lg" id="modal_obj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo/Editar Objetivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 espaco1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" v-model="objetivo_nome" class="form-control form-control-sm">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" v-on:click.prevent="save_objetivo()">Salvar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Estrategia -->
<div class="modal fade bd-example-modal-lg" id="modal_est" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo/Editar Estrategia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-md-12 espaco1">

                <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" v-model="estrategia_nome" class="form-control form-control-sm">
                </div>

            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" v-on:click.prevent="save_estrategia()">Salvar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Indicador -->
<div class="modal fade bd-example-modal-lg" id="modal_ind" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> #{{this.indicador_id}} Indicador</h5>
        <!-- <button type="button" class="btn btn-outline-info btn-sm" v-on:click.prevent="show_editar_indicador()"> editar </button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-md-12 espaco1">
                <div class="form-group">
                    <label for="indicador_nome">Nome</label>
                    <input type="text" v-model="indicador_nome" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-md-6" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="complexidade">Complexidade</label>
                    <input type="text" v-model="indicador_complexidade" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-md-6" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="utilizacao_recurso_finan">Utilizacao de recurso financeiros</label>
                    <input type="text" v-model="indicador_utilizacao_recurso_finan" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-md-6 espaco1" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="capacidade_transformacao">Capacidade de transformação</label>
                    <input type="text" v-model="indicador_capacidade_transformacao" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-md-6 espaco1" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="soma_peso">Soma do peso</label>
                    <input type="text" v-model="indicador_soma_peso" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-md-12 espaco1" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="indicador_meta_agregada">Meta agregada</label>
                    <input type="text" v-model="indicador_meta_agregada" class="form-control form-control-sm">
                </div>
            </div>
            <div  v-if="!caixa_escolha_ano_para_meta && this.indicador_id>0" class="col-md-12 espaco1">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-info btn-sm" v-on:click.prevent="show_caixa_ano_meta(1)">
                        <i class="fas fa-plus"></i> ANO
                    </button>
                </div>
            </div>

                    <!-- ************************************************************************************************* -->
                    <section v-if="caixa_escolha_ano_para_meta">
                        <div class="col-md-12 espaco1">

                            <div class="card">
                            <div class="card-body" style="background-color: #eee;">

                                    <div class="form-group">
                                        <label>
                                        <b>Digite o ano para inserir ( Meta, Realizado e Situação ) no indicador!</b>
                                        </label>
                                        <input type="text" v-model="ano_de_indicador_meta" class="form-control form-control-sm">
                                    </div>

                                    <div class="row">
                                        <div class="col-10">
                                            <a href="#" class="btn btn-info btn-sm" v-on:click.prevent="inserir_novo_ano_meta_indicador()">Inserir</a>
                                            <button class="btn btn-danger btn-sm" v-on:click.prevent="delete_ano_meta_indicador()">Delete</button>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-secondary btn-sm btn-block" v-on:click.prevent="show_caixa_ano_meta(0)">Fechar</button>
                                        </div>
                                    </div>

                            </div>
                            </div>

                        </div>
                    </section>

                    <div class="col-md-12 espaco1">
                        <div class="row">
                            <div class="col-md-4" v-for="n of indicador_meta">
                                <div v-if="n.tipo !='problema' && n.tipo !='situacao'" class="form-group">
                                    <label for="indicador_meta_agregada">{{n.tipo+' '+n.ano}}</label>
                                    <input type="text" :name="n.tipo+'_'+n.ano+'_'+n.id"  v-model="meta_input_dinamico[n.tipo+'_'+n.ano+'_'+n.id]" class="form-control form-control-sm">
                                </div>

                                <div v-if="n.tipo =='problema'" class="form-group">
                                    <label for="indicador_meta_agregada">{{n.tipo+' '+n.ano}}</label>
                                    <select :name="n.tipo+'_'+n.ano+'_'+n.id" v-model="meta_input_dinamico[n.tipo+'_'+n.ano+'_'+n.id]" class="form-control form-control-sm">
                                        <option disabled value="">Escolha um item</option>
                                        <option v-for="p in problema" v-bind:value="p.id">
                                            {{ p.nome }}
                                        </option>
                                    </select>
                                </div>

                                <div v-if="n.tipo =='situacao'" class="form-group">
                                    <label for="indicador_meta_agregada">{{n.tipo+' '+n.ano}}</label>
                                    <select :name="n.tipo+'_'+n.ano+'_'+n.id" v-model="meta_input_dinamico[n.tipo+'_'+n.ano+'_'+n.id]" class="form-control form-control-sm">
                                        <option disabled value="">Escolha um item</option>
                                        <option v-for="option in situacoes" v-bind:value="option.id">
                                            {{ option.nome }}
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- ************************************************************************************************* -->

            <div class="col-md-12 espaco1" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="indicador_realizado_acumulado">Realizado acumulado</label>
                    <input type="text" v-model="indicador_realizado_acumulado" class="form-control form-control-sm">
                </div>
            </div>

            <div class="col-md-12 espaco1" v-if="this.indicador_id>0">
                <div class="form-group">
                    <label for="indicador_execucao_agregada">Execução agregada</label>
                    <input type="text" v-model="indicador_execucao_agregada" class="form-control form-control-sm">
                </div>
            </div>

            <div class="col-md-4 espaco1">
                <div class="form-group">
                    <label for="indicador_status">Status</label>
                    <select class="form-control-sm form-control form-control-sm" v-model="indicador_status">
                        <option disabled value="">Escolha um item</option>
                        <option v-for="p in status" v-bind:value="p.valeu">
                            {{p.text}}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-8 espaco1" v-if="this.indicador_id>0">
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="indicador_responsavel">Responsável</label>
                            <input type="text" v-model="indicador_responsavel" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="indicador_responsavel" style="color:transparent;">Responsável</label>
                            <button class="btn btn-warning btn-sm btn-block" v-on:click.prevent="show_orgaos()"> <i class="fa fa-expand" aria-hidden="true"></i> </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="show_tabela_orgao" v-if="this.indicador_id>0" style="height: 400px; overflow:auto;">
            <div class="col-md-12">
                <div class="form-group">

                    <!-- <div class="row">
                    <div class="col-md-12"> -->
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <!-- <th>id</th> -->
                                <th>sigla</th>
                                <th>nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr-shadow" v-for="orgao of orgaos">
                                <!-- <td>{{orgao.id}}</td> -->
                                <td>{{orgao.sigla}}</td>
                                <td>{{orgao.nome}}</td>
                                <td><button class="btn btn-secondary btn-sm" v-on:click.prevent="incluir_responsavel_indicador(orgao.id)">vincular</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- </div>
                    </div> -->

                </div>
            </div>
            </div>



        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" v-on:click.prevent="save_indicador()">Salvar</button>
      </div>
    </div>
  </div>
</div>


</section>
</template>

<script>
    import axios from 'axios';

    export default {

        props: ['url', 'plano_id'],

        data(){
            return{

                //array
                errors: [],
                perspectiva: [],
                orgaos: [],
                problema: [],

                situacoes: [
                    {value:'A', text: 'Ativo - exemplo01'},
                    {value:'B', text: 'Negativo - exemplo02'},
                ],

                status: [
                    {valeu:0, text:'Em planejamento'},
                    {valeu:1, text:'Em licitação'},
                    {valeu:2, text:'A iniciar'},
                    {valeu:3, text:'Em execução'},
                    {valeu:4, text:'Paralisado'},
                    {valeu:5, text:'Concluído'},
                    {valeu:6, text:'Cancelada'},
                ],

                //variaveis
                perspectiva_id: null,
                perspectiva_nome: null,

                objetivo_id: null,
                objetivo_per_id: null,
                objetivo_nome: null,

                estrategia_id: null,
                estrategia_obj_id: null,
                estrategia_nome: null,

                indicador_id: null,
                indicador_est_id: null,
                indicador_nome: null,
                indicador_meta_agregada: null,
                indicador_execucao_agregada: null,
                indicador_realizado_acumulado: null,
                indicador_status: null,
                indicador_responsavel: null,
                indicador_meta: null,
                indicador_complexidade: null,
                indicador_utilizacao_recurso_finan: null,
                indicador_capacidade_transformacao: null,
                indicador_soma_peso: null,

                //variaveis filtro
                descricao: null,
                nivel_pesq: "ind",
                caixa_load: false,

                //outros
                box_main: true,
                box_indicador: false,
                visualizar_indicador: false,
                editar_indicador: false,
                obj_nome: null,
                ano_de_indicador_meta: null,
                caixa_escolha_ano_para_meta: false,
                show_tabela_orgao: false,

                //objeto
                meta_input_dinamico: {},
                meta_select_dinamico: {},
            }
        },

        mounted() {
            this.consulta();
            this.get_orgaos("");
            this.get_problema();
            this.get_situacao();
        },

        methods: {

            get_situacao(){
                axios.get(this.url+'api/planejamento/situacao/all',)
                .then(response => {
                    this.situacoes = response.data;
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },

            get_problema(){
                axios.get(this.url+'api/planejamento/problema/all',)
                .then(response => {
                    this.problema = response.data;
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },

            get_orgaos(pesq){
                var body = {
                  pesq: pesq,
                };

                axios.post(this.url+'api/planejamento/orgao/find', body)
                .then(response => {
                    this.orgaos = response.data;
                    console.log(this.orgaos);
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            get_responsaveis(){
                //consulte responsaveis
                axios.get(this.url+'api/planejamento/indicador/'+this.indicador_id+'/responsavel/all',)
                .then(response => {
                    this.indicador_responsavel = response.data;
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            incluir_responsavel_indicador(orgao_id){

                var body = {
                  indicador_id: this.indicador_id,
                  orgao_id: orgao_id,
                };

                axios.post(this.url+'api/planejamento/indicador/incluir_responsavel', body)
                .then(response => {

                    this.get_responsaveis();
                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },

            consulta(){
                var body = {
                  plano_id: this.plano_id,
                  descricao: this.descricao,
                  nivel_pesq: this.nivel_pesq,
                };

                this.caixa_load = true
                axios.post(this.url+'api/planejamento/consulta', body)
                .then(response => {
                    this.perspectiva = response.data;

                    this.caixa_load = false
                })
                  .catch(e => {
                    this.errors.push(e);
                    this.caixa_load = false
                });

            },


            //--------perspectiva--------------------------------------------//
            set_perspectiva(id, nome){
                this.perspectiva_id = id;
                this.perspectiva_nome = nome;
            },

            save_perspectiva(){
                var body = {
                  id: this.perspectiva_id,
                  plano_id: this.plano_id,
                  nome: this.perspectiva_nome,
                };

                axios.post(this.url+'api/planejamento/perspectiva/save', body)
                .then(response => {
                    this.consulta();
                }).catch(e => {this.errors.push(e); });
            },

            delete_perspectiva(id){
                axios.get(this.url+'api/planejamento/perspectiva/delete/'+id)
                .then(response => {
                    console.log(response.data);
                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },

            //------ objetivo ----------------------------------------------//
            set_objetivo(id, per_id, nome){
                this.objetivo_id = id;
                this.objetivo_per_id = per_id;
                this.objetivo_nome = nome;
            },

            save_objetivo(){

                var body = {
                  id: this.objetivo_id,
                  per_id: this.objetivo_per_id,
                  nome: this.objetivo_nome,
                };

                axios.post(this.url+'api/planejamento/save_objetivo', body)
                .then(response => {
                    this.consulta();
                }) .catch(e => {this.errors.push(e); });
            },

            delete_objetivo(id){
                axios.get(this.url+'api/planejamento/objetivo/delete/'+id)
                .then(response => {
                    console.log(response.data);
                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            //------ estrategia -------------------------------------------//
            set_estrategia(id, obj_id, nome){
                this.estrategia_id = id;
                this.estrategia_obj_id = obj_id;
                this.estrategia_nome = nome;

                console.log(this.estrategia_id)
                console.log(this.estrategia_per_id)
                console.log(this.estrategia_nome)
            },

            save_estrategia(){
                var body = {
                  id: this.estrategia_id,
                  obj_id: this.estrategia_obj_id,
                  nome: this.estrategia_nome,
                };

                axios.post(this.url+'api/planejamento/save_estrategia', body)
                .then(response => {
                    console.log(response.data);
                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },

            delete_estrategia(id){
                axios.get(this.url+'api/planejamento/estrategia/delete/'+id)
                .then(response => {
                    console.log(response.data);
                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            //------ indicador -------------------------------------------------------------//
            set_indicador(id,est_id){

                if (id == 0) {
                    this.indicador_id = 0;
                    this.indicador_est_id = est_id;
                    this.indicador_nome = "";
                    this.indicador_meta_agregada = "";
                    this.indicador_realizado_acumulado = ""
                    this.indicador_execucao_agregada = "";
                    this.indicador_status = "";
                    this.indicador_responsavel = "";
                    this.indicador_complexidade = "";
                    this.indicador_utilizacao_recurso_finan = "";
                    this.indicador_capacidade_transformacao = "";
                    this.indicador_soma_peso = "";
                    this.indicador_meta = {};
                    this.meta_input_dinamico = {};
                }


                if (id > 0) {
                    axios.get(this.url+'api/planejamento/indicador/find/'+id)
                    .then(response => {

                        this.indicador_id = response.data[0].id;
                        this.indicador_est_id = response.data[0].est_id;
                        this.indicador_nome = response.data[0].nome;
                        this.indicador_meta_agregada = response.data[0].meta_agregada;
                        this.indicador_realizado_acumulado = response.data[0].realizado_acumulado;
                        this.indicador_execucao_agregada = response.data[0].execucao_agregada;
                        this.indicador_status = response.data[0].status;
                        this.indicador_responsavel = response.data[0].responsavel;
                        this.indicador_complexidade = response.data[0].complexidade;
                        this.indicador_utilizacao_recurso_finan = response.data[0].utilizacao_recurso_finan;
                        this.indicador_capacidade_transformacao = response.data[0].capacidade_transformacao;
                        this.indicador_soma_peso = response.data[0].soma_peso;
                        this.indicador_meta = response.data[0].meta;


                        for (var i = 0; i <= this.indicador_meta.length-1;  i++){

                            var variavel = this.indicador_meta[i].tipo+'_'+this.indicador_meta[i].ano+'_'+this.indicador_meta[i].id;

                            //essa foi boa! convertendo string em variavel
                            this.meta_input_dinamico[variavel] = this.indicador_meta[i].valor;

                            this.meta_select_dinamico[variavel] = this.indicador_meta[i].valor;

                        }


                        this.get_responsaveis();

                    })
                      .catch(e => {
                        this.errors.push(e);
                    });
                }

            },


            save_indicador(){
                var body = {
                  id : this.indicador_id,
                  est_id: this.indicador_est_id,
                  nome: this.indicador_nome,
                  meta_agregada: this.indicador_meta_agregada,
                  realizado_acumulado: this.indicador_realizado_acumulado,
                  execucao_agregada: this.indicador_execucao_agregada,
                  status: this.indicador_status,
                  responsavel: this.indicador_responsavel,
                  complexidade: this.indicador_complexidade,
                  utilizacao_recurso_finan: this.indicador_utilizacao_recurso_finan,
                  capacidade_transformacao: this.indicador_capacidade_transformacao,
                  soma_peso: this.indicador_soma_peso,
                  meta: this.meta_input_dinamico,
                };

                axios.post(this.url+'api/planejamento/indicador/save', body)
                .then(response => {

                    console.log(response.data);

                    this.indicador_id = response.data;

                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            inserir_novo_ano_meta_indicador(){

                var body = {
                  indicador_id : this.indicador_id,
                  ano : this.ano_de_indicador_meta,
                };

                axios.post(this.url+'api/planejamento/indicador/inserir_novo_ano_meta_indicador', body)
                .then(response => {
                    this.set_indicador(this.indicador_id);
                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },

            delete_ano_meta_indicador(){

                var body = {
                  indicador_id : this.indicador_id,
                  ano : this.ano_de_indicador_meta,
                };

                axios.post(this.url+'api/planejamento/indicador/delete_ano_meta_indicador', body)
                .then(response => {
                    this.set_indicador(this.indicador_id);
                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },


            delete_indicador(id){
                axios.get(this.url+'api/planejamento/indicador/'+id+'/delete')
                .then(response => {
                    this.consulta();
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },



            /*--SHOW----------------------------*/

            show_caixa_ano_meta(n){

                if(n == 0){
                    this.caixa_escolha_ano_para_meta = false;
                }else{
                    this.caixa_escolha_ano_para_meta = true;
                }

            },

            show_orgaos(){

                let n = this.show_tabela_orgao;

                if(n){
                    this.show_tabela_orgao = false;
                }else{
                    this.show_tabela_orgao = true;
                }
            },

            limpar(){
                this.descricao = null
            },

        },

    }
</script>


<style>

    .espaco1{
        margin-bottom: 10px;
    }

</style>
