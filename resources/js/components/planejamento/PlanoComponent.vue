<template>
<div class="page-content--bgf7">

    <br>

    <section class="p-t-20">
    <div class="container">

        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-10 offset-md-2" >
                <button class="btn btn-primary btn-sm" @click="consulta()">Novo plano</button>
            </div>
        </div>

        <div class="row">
        <div class="col-md-8 offset-md-2" >

            <div v-for="p of plano">
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-10">
                    <a v-bind:href="url+'planejamento/plano/'+p.id+'/perspectiva'" type="button"
                    class="btn btn-outline-secondary btn-sm btn-block"> {{p.nome}} </a>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-secondary btn-sm">Editar</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
            </div>
            </div>

        </div>
        </div>

    </div>
    </section>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</div>
</template>

<script>
    import axios from 'axios';

    export default {

        props: ['url'],

        data(){
            return{
                errors: [],
                plano: [],
            }
        },

        mounted() {
            this.get_plano();
        },

        methods: {

            get_plano(){
                //pegue o torneio
                axios.get(this.url+'api/planejamento/get_plano')
                .then(response => {
                    this.plano = response.data;

                    console.log(response.data);
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            }

        },

    }
</script>
