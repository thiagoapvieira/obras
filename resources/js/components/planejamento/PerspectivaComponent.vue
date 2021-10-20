<template>
<section class="p-t-20">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <!-- perspectiva -->
            <div class="row">            
                <div class="col-lg-11">
                    <h2 class="title-5 m-b-35">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#perspectiva" v-on:click.prevent="consulta()"> 
                            <i class="fas fa-plus"></i>
                        </button>

                        Perspectiva 
                    </h2>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-12">
                    
                    <div class="card" v-for="(p, key) of perspectiva">
                        <div class="card-header">
                            <strong class="card-title"> 

                                <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">

                                    <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_per"
                                    v-on:click.prevent="set_perspectiva()"> 
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    
                                    <button class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_obj"
                                    v-on:click.prevent="set_objetivo(0, p.id, '')"> 
                                        <i class="fas fa-plus"></i>
                                    </a>

                                </div>
                                
                                {{p.id}} {{p.nome}}

                                <!--
                                <small>
                                    <span class="badge badge-success float-right mt-1">Success</span>
                                </small>
                                -->

                            </strong>
                        </div>
                        <div class="card-body" v-for="(n, key2) of perspectiva[key].objeto">
                            
                                <!-- objetivos -->
                                <div style="margin-bottom: 15px;">
                                    <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">
                                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_obj"
                                           v-on:click.prevent="set_objetivo(n.id, n.per_id, n.nome)"> 
                                           <i class="fas fa-pencil-square-o"></i>
                                        </a>

                                        <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal_obj">
                                        <i class="fas fa-trash"></i>
                                        </a>

                                        <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_obj"
                                           v-on:click.prevent="set_objetivo(0, n.id, '')">
                                           <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    <b> {{n.nome}} </b>
                                </div>
                                
                                <!-- Estrategia -->
                                <div style="margin-left: 15px; margin-bottom: 10px;" v-for="(e,key3) of perspectiva[key].objeto[key2].estrategia">
                                    <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">                                       
                                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal_est"
                                           v-on:click.prevent="set_estrategia(e.id, e.obj_id, e.nome)"> 
                                           <i class="fas fa-pencil-square-o"></i>
                                        </a>
                                        <button class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_obj"
                                           v-on:click.prevent="set_indicador(0, e.id, '')">
                                           <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    {{e.nome}}

                                    <!-- indicadores -->
                                    <div class="indicadores" v-for="ind of perspectiva[key].objeto[key2].estrategia[key3].indicador" 
                                    v-on:click.prevent="set_indicador(ind.id)">
                                        <div style="margin: 10px 0 10px 30px;">
                                            <a href="#" data-toggle="modal" data-target="#modal_ind">
                                                {{ind.nome}}
                                            </a>
                                        </div>
                                    </div>

                                </div>

                                
                        </div>
                    </div>

                </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Indicador</h5>
        <button type="button" class="btn btn-outline-info btn-sm" v-on:click.prevent="show_editar_indicador()"> editar </button>

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

            <div class="col-md-12 espaco1">                
                <div class="form-group">
                    <label for="indicador_meta_agregada">Meta agregada</label>
                    <input type="text" v-model="indicador_meta_agregada" class="form-control form-control-sm">
                </div>
            </div>
            
            <div class="col-md-12 espaco1">
                
                <section v-for="n of indicador_meta">
                <h3>2019</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="indicador_meta_agregada">Meta</label>
                            {{n.id}}
                            <input type="text" :name="'meta_' + n.id"  v-model="form.parent_id[n.tipo+'_'+n.ano+'_'+n.id]" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <b>Realizado:</b> <br>Número de leitos de UTI pediátrica implantados
                    </div>

                    <div class="col-md-4">                        
                        <b>Situação:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>
                </div>
                <br>


                

                </section>    

                <h1>-------------</h1>
                <div v-for="n of indicador_meta">
                    {{ form.parent_id[n.tipo+'_'+n.ano+'_'+n.id] }}
                </div>            
                <h1>-------------</h1>

                                
                
            </div>
                

            <div class="col-md-12 espaco1">
                <b>Realizado acumulado:</b> <br> reforma realizada e mobiliários e equipamentos adquiridos
            </div>            

            <div class="col-md-12 espaco1">                
                <div class="form-group">
                    <label for="indicador_execucao_agregada">Execução agregada</label>
                    <input type="text" v-model="indicador_execucao_agregada" class="form-control form-control-sm">
                </div>                
            </div>

            <div class="col-md-12 espaco1">                
                <div class="form-group">
                    <label for="indicador_status">Status</label>
                    <input type="text" v-model="indicador_status" class="form-control form-control-sm">
                </div>                
            </div>            

            <div class="col-md-12 espaco1">                
                <div class="form-group">
                    <label for="indicador_responsavel">Responsável</label>
                    <input type="text" v-model="indicador_responsavel" class="form-control form-control-sm">
                </div>                
            </div>            

        </div>
        

       <!--  <section v-show="editar_indicador">
        <div class="row">
            <div class="col-md-12 espaco1">
                <b>Nome:</b> 
                <input type="text" name="obj_id" class="form-control form-control-sm" placeholder="obj_id" >


            </div> 
        </div>
        </section>  -->   


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>        
        <button type="button" class="btn btn-success btn-sm">Salvar</button>        
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
                perspectiva: [],

                //variaveis
                perspectiva_id: 1,

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
                indicador_status: null,
                indicador_responsavel: null,
                indicador_meta: null,

                box_main: true,
                box_indicador: false,
                visualizar_indicador: false,
                editar_indicador: false,
                obj_nome: null,

                form: {
                  parent_id: []
                },

               

            }
        },

        mounted() {

            this.consulta();

        },

        methods: {

            consulta(){
                
                var body = {
                  plano_id: this.plano_id,
                  //perspectiva_id: this.perspectiva_id,
                };

                axios.post(this.url+'api/planejamento/consulta', body)
                .then(response => {
                    
                    this.perspectiva = response.data;

                    console.log(response.data);

                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },

            // show_visulizar_indicador(){

            //     this.visualizar_indicador = true;
            //     this.editar_indicador = false;

            // },

            // show_editar_indicador(){

            //     this.visualizar_indicador = false;
            //     this.editar_indicador = true;

            // },


            //------ objetivo -----------------------//
            set_objetivo(id, per_id, nome){
                this.objetivo_id = id;
                this.objetivo_per_id = per_id;
                this.objetivo_nome = nome;

                // console.log(this.objetivo_id)
                // console.log(this.objetivo_per_id)
                // console.log(this.objetivo_nome)

            },

            save_objetivo(){

                var body = {
                  id: this.objetivo_id,
                  per_id: this.objetivo_per_id,
                  nome: this.objetivo_nome,
                };

                axios.post(this.url+'api/planejamento/save_objetivo', body)
                .then(response => {

                    console.log(response.data);

                    this.consulta();

                })
                  .catch(e => {
                    this.errors.push(e);
                });
            },


            //------ estrategia -----------------------//
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


            //------ indicador -----------------------//
            set_indicador(id){                

                axios.get(this.url+'api/planejamento/indicador/find/'+id)
                .then(response => {                   

                    //console.log(response.data[0].id);

                    this.inidicador = response.data;

                    this.indicador_nome = response.data[0].nome;
                    this.indicador_meta_agregada = response.data[0].meta_agregada;
                    this.indicador_realizado_acumulado = response.data[0].realizado_acumulado;                    
                    this.indicador_execucao_agregada = response.data[0].execucao_agregada;
                    this.indicador_meta = response.data[0].meta;
                    this.indicador_status = response.data[0].status;
                    this.indicador_responsavel = response.data[0].responsavel;

                })
                  .catch(e => {
                    this.errors.push(e);
                });


                console.log(this.form.parent_id);
                
                console.log(this.form.parent_id['meta_2019_1']);

                
            },

            /*
            save_estrategia(){

                var body = {
                  id: this.indicador_id,
                  est_id: this.indicador_est_id,
                  nome: this.indicador_nome,
                };

                axios.post(this.url+'api/planejamento/save_indicador', body)
                .then(response => {

                    console.log(response.data);

                    this.consulta();

                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },
            */





        },

    }
</script>


<style>

    .espaco1{
        margin-bottom: 10px;
    }
    
</style>
