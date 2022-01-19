<template>
<div class="page-content--bgf7">

    <section class="p-t-20">
    <div class="container">
    <div class="row">
    <div class="col-md-6 offset-md-3" >

        <div v-for="p of plano">
            <a v-bind:href="url+'planejamento/plano/'+p.id+'/perspectiva'" type="button" class="btn btn-outline-secondary btn-sm btn-block">
                {{p.nome}}
            </a>
            <br>
        </div>

    </div>
    </div>
    </div>
    </section>

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
                axios.get(this.url+'api/planejamento/relatorio/objetivo/orgao_id/2')
                .then(response => {
                    // this.plano = response.data;
                    console.log(response.data);
                })
                  .catch(e => {
                    this.errors.push(e);
                });
            }

        },

    }
</script>
