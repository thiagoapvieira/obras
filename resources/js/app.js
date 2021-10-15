require('./bootstrap');

window.Vue = require('vue').default;

//declaracao dos componente
Vue.component('inicio_component', require('./components/planejamento/InicioComponent.vue').default);
Vue.component('perspectiva_component', require('./components/planejamento/PerspectivaComponent.vue').default);

const app = new Vue({    
    el: '#app',    
});