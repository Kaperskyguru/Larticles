
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');
import vueRouter from 'vue-router';
import Routes from './routes';

Vue.use(vueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const router = new vueRouter({
    routes:Routes,
    mode: 'history',
 });

Vue.component('navbar', require('./components/Navbar.vue'));

const app = new Vue({
    el: '#app',
    router:router,
});
