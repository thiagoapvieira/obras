<template>
<section class="p-t-20">


<section v-if="box_indicador">
<div class="container-fluid">
<div class="content-wrapper">
<div class="content-header">

    <div class="row">
        <div class="col-md-11">
            <h3>[PE:1] RESULTADOS PARA A SOCIEDADE</h3>
            <br>
            <h5>[OE:1.1] Ampliar o acesso e qualificar as ações e serviços de saúde da atenção ambulatorial, hospitalar e de vigilância, de forma integrada com a Atenção Primária à Saúde </h5>
            <br>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-info btn-sm" v-on:click.prevent="hide_box_indicador()"> 
                <i class="fas fa-plus"></i> fechar
            </button>
        </div>    
    </div>

<div class="row" v-for="n in 10">
<div class="col-md-12">
<div class="card">
<div class="card-body">

    <div class="col-md-12 espaco1">
        <h4 style="color:maroon;">Número de leitos de UTI pediátrica implantados</h4>
    </div>            

    <div class="col-md-12 espaco1">
        <b>Meta agregada:</b> <br>CAISM, CASE e SVO: reforma realizada e mobiliários e equipamentos adquiridos
    </div>

    <div class="col-md-12 espaco1" v-for="n in 6" style="margin-bottom:10px;">
        
        <h5>2019</h5>
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

        
    </div>        
    
    <div class="col-md-12 espaco1">
    <div class="row">
        <div class="col-md-3">
            <b>Realizado acumulado:</b> <br> reforma realizada e mobiliários e equipamentos adquiridos
        </div>

        <div class="col-md-3">
            <b>Execução agregada:</b> <br> 99.9999999%
        </div>

        <div class="col-md-3">
            <b>Status:</b> <br> FEITO 
        </div>

        <div class="col-md-3">
            <b>Responsável:</b> <br>SES, SCOM, SEGG
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
</section>

<!--  -->





<section v-if="box_main">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <!-- perspectiva -->
            <div class="row">            
                <div class="col-lg-11">
                    <h2 class="title-5 m-b-35">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#perspectiva" v-on:click.prevent="get_perspectiva()"> 
                            <i class="fas fa-plus"></i>
                        </button>

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
                                    <b> [OE:1.1] Ampliar o acesso e qualificar as ações e serviços de saúde da atenção ambulatorial, hospitalar e de vigilância, de forma integrada com a Atenção Primária à Saúde </b>
                                </div>
                                
                                <div style="margin-left: 15px; margin-bottom: 10px;" v-for="n in 6">
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

                                    <!-- indicadores -->                                                                        
                                    <div style="margin: 10px 0 10px 30px;">
                                        [1:1:4:EST] Fortalecer a Rede de Atenção à Saúde do Trabalhador
                                    </div>
                                    <div style="margin: 10px 0 10px 30px;">
                                         [1:1:5:EST] Fortalecer a Política de Educação Permanente em Saúde tendo como foco a valorização e qualificação dos trabalhadores do SUS e de seus processos de trabalho
                                    </div>
                                    <div style="margin: 10px 0 10px 30px;">
                                         [1:2:2:EST] Implantar o PlanificaSus (Organização da Atenção Ambulatorial Especializada em Rede com a Atenção Primária à Saúde) na Região de Saúde de Lagarto e de Itabaiana
                                    </div>

                                </div>

                                
                        </div>
                    </div>

                </div>
            </div>



        </div>            
    </div>            
</div>
</section>


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
                perspectivas: [],

                //variaveis
                perspectiva_id: 1,

                //temp
                numbers: [ 1, 2, 3, 4, 5 ],

                box_main: true,
                box_indicador: false,

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
