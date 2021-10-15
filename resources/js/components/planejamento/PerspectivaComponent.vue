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
                                    <button  data-toggle="modal" data-target="#staticModal">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                </div>
                                
                                {{p.nome}}

                                <small>
                                    <span class="badge badge-success float-right mt-1">Success</span>
                                </small>
                            </strong>
                        </div>
                        <div class="card-body" v-for="(n, key2) of perspectiva[key].objeto">
                            
                                <!-- objetivos -->
                                <div style="margin-bottom: 15px;">
                                    <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">
                                        <button class="btn btn-outline-secondary">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <button class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <b> {{n.nome}} </b>
                                </div>
                                
                                <!-- Estrategia -->
                                <div style="margin-left: 15px; margin-bottom: 10px;" v-for="(e,key3) of perspectiva[key].objeto[key2].estrategia">
                                    <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">                                       
                                        <button class="btn btn-outline-secondary">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <button class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    {{e.nome}}

                                    <!-- indicadores -->  
                                    <div class="indicadores" v-for="e of perspectiva[key].objeto[key2].estrategia[key3].indicador">
                                        <div style="margin: 10px 0 10px 30px;">
                                            <a href="#" data-toggle="modal" data-target="#exampleModal">
                                                {{e.nome}}
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Indicador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row" v-for="n in 1">            

            <div class="col-md-12 espaco1">
                <b>Nome:</b> <br>Número de leitos de UTI pediátrica implantados                
            </div>            

            <div class="col-md-12 espaco1">
                <b>Meta agregada:</b> <br>CAISM, CASE e SVO: reforma realizada e mobiliários e equipamentos adquiridos
            </div>

            <div class="col-md-12 espaco1">
                
                <h3>2019</h3>
                <div class="row">
                    <div class="col-md-4">                        
                        <b>Meta agregada:</b> <br>Número de leitos de UTI pediátrica implantados
                    </div>

                    <div class="col-md-4">
                        <b>Realizado:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>

                    <div class="col-md-4">                        
                        <b>Situação:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>
                </div>
                <br>                

                <h3>2020</h3>
                <div class="row">
                    <div class="col-md-4">                        
                        <b>Meta agregada:</b> <br>Número de leitos de UTI pediátrica implantados
                    </div>

                    <div class="col-md-4">
                        <b>Realizado:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>

                    <div class="col-md-4">                        
                        <b>Situação:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>
                </div>
                <br>                

                <h3>2020</h3>
                <div class="row">
                    <div class="col-md-4">                        
                        <b>Meta agregada:</b> <br>Número de leitos de UTI pediátrica implantados
                    </div>

                    <div class="col-md-4">
                        <b>Realizado:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>

                    <div class="col-md-4">                        
                        <b>Situação:</b> <br>Número de leitos de UTI pediátrica implantados                        
                    </div>
                </div>
                <br>                
                
            </div>
                

            <div class="col-md-12 espaco1">
                <b>Realizado acumulado:</b> <br> reforma realizada e mobiliários e equipamentos adquiridos
            </div>

            <div class="col-md-12 espaco1">
                <b>Execução agregada:</b> <br> 99.9999999%
            </div>

            <div class="col-md-12 espaco1">
                <b>Status:</b> <br> FEITO 
            </div>

            <div class="col-md-12 espaco1">
                <b>Responsável:</b> <br>SES, SCOM, SEGG
            </div>

        </div>    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>

</section>
</template>

<script>
    import axios from 'axios';

    export default {

        props: ['url'],

        data(){
            return{    

                //array
                perspectiva: [],

                //variaveis
                perspectiva_id: 1,

                //temp
                numbers: [ 1, 2, 3, 4, 5 ],

                box_main: true,
                box_indicador: false,

            }
        },

        mounted() {

            this.consulta();

        },

        methods: {

            consulta(){
                
                var body = {
                  perspectiva_id: this.perspectiva_id,
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

            show_indicador(){

                this.box_main = false;
                this.box_indicador = true;

            },

            hide_box_indicador(){

                this.box_main = true;
                this.box_indicador = false;

            },

        },

    }
</script>


<style>

    .espaco1{
        margin-bottom: 10px;
    }
    
</style>
