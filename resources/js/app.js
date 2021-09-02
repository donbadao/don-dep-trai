/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');


// window.Vue = require('vue').default;
// import Vue from 'vue'
// import router from './router.js'

// Vue.use(router)

// // Vue.component('post-component', require('./components/PostComponent.vue').default);
// // Vue.component('modaldelete', require('./components/ModalDeleteComponent.vue').default);
// // Vue.component('media', require('./components/MediaComponent.vue').default);
// Vue.component('app', require('./components/App.vue').default);

// const app = new Vue({
//     el: '#app',
//     router
// });

require('./bootstrap');
window.Vue = require('vue').default;
import Vue from 'vue'
// import router from './router.js'

// Vue.use(router)

Vue.component('postcomponent', require('./components/PostComponent.vue').default);
Vue.component('media', require('./components/MediaComponent.vue').default);
const app = new Vue({
    el: '#app',
  //  router
});