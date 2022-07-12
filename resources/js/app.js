require('./bootstrap');

window.Vue = require('vue').default;

//declaracao dos componente
Vue.component('plano_component', require('./components/planejamento/PlanoComponent.vue').default);
Vue.component('perspectiva_component', require('./components/planejamento/PerspectivaComponent.vue').default);
Vue.component('relatorio_por_orgao_component', require('./components/planejamento/RelatorioPorOrgaoComponent.vue').default);

const app = new Vue({
    el: '#app',
});