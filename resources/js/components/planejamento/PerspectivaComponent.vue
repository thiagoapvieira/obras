<template>
<section class="p-t-20">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <!-- perspectiva -->
            <div class="row">            
                <div class="col-lg-11">
                    <h2 class="title-5 m-b-35">
                        <!-- <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#perspectiva" v-on:click.prevent="get_perspectiva()"> 
                            <i class="fas fa-plus"></i>
                        </button> -->

                        Perspectiva 
                    </h2>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-12">
                    
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title"> 

                                <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">
                                    <button  data-toggle="modal" data-target="#staticModal">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                </div>
                                [PE:1] RESULTADOS PARA A SOCIEDADE 

                                <small>
                                    <span class="badge badge-success float-right mt-1">Success</span>
                                </small>
                            </strong>
                        </div>
                        <div class="card-body">
                            
                                <div style="margin-bottom: 15px;">
                                    <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Second group">
                                        
                                        <!-- <button  data-toggle="modal">
                                            <i class="fas fa-align-justify"></i>
                                        </button> -->
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
                                    <b>
                                        [OE:1.1] Ampliar o acesso e qualificar as ações e serviços de saúde da atenção ambulatorial, hospitalar e de vigilância, de forma integrada com a Atenção Primária à Saúde
                                    </b>    
                                </div>
                                
                                <div style="margin-left: 15px; margin-bottom: 10px;">
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

                                    <a href="#" data-toggle="modal" data-target="#exampleModal">[ES:1.1.1] Estruturar e fortalecer unidades ambulatoriais e hospitalares da rede própria</a>
                                </div>

                                <div style="margin-left: 15px;">
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
                                    [ES:1.1.1] Estruturar e fortalecer unidades ambulatoriais e hospitalares da rede própria
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
        
        <div class="row">            

            <div class="col-md-12">
                <b>Nome:</b> <br>Número de leitos de UTI pediátrica implantados                
            </div>            

            <div class="col-md-12">
                <b>Meta agregada:</b> <br>CAISM, CASE e SVO: reforma realizada e mobiliários e equipamentos adquiridos
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        meta 2019 
                    </div>

                    <div class="col-md-4">
                        realizado 2019
                    </div>

                    <div class="col-md-4">
                        situação 2019
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-4">
                        meta 2020
                    </div>
                    
                    <div class="col-md-4">    
                        realizado 2020
                    </div>

                    <div class="col-md-4">
                        situação 2020
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        meta 2021
                    </div>
                    
                    <div class="col-md-4">    
                        realizado 2021
                    </div>

                    <div class="col-md-4">
                        situação 2021
                    </div>
                </div>
            </div>

                <!-- INDICADOR   INSERIDO    NA      REVISÃO     BIENAL  2020        10.000 amostras analisadas          11.000 novas amostras analisadas -->

            <div class="col-md-12">
                <b>Realizado acumulado:</b> <br> reforma realizada e mobiliários e equipamentos adquiridos
            </div>

            <div class="col-md-12">
                <b>Execução agregada:</b> <br> 99.9999999%
            </div>

            <div class="col-md-12">
                <b>Status:</b> <br> FEITO 
            </div>

            <div class="col-md-12">
                <b>Responsável:</b> SES, SCOM, SEGG<br>
            </div>

        </div>    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
                perspectivas: [],

                //variaveis
                perspectiva_id: 1,

            }
        },

        mounted() {

            this.get_perspectiva();

        },

        methods: {

            get_perspectiva(){
                
                var body = {
                  perspectiva_id: this.perspectiva_id,
                };

                axios.post(this.url+'api/planejamento/get_perspectiva', body)
                .then(response => {
                    this.perspectivas = response.data;                    
                })
                  .catch(e => {
                    this.errors.push(e);
                });

            },

        },

    }
</script>
