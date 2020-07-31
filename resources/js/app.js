const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * Components
 */
Vue.component('currency-converter', require('./components/CurrencyConverter.vue').default);

const app = new Vue({
    el: '#app',
});
