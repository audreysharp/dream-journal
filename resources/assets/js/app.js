
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// event bus
const evt = new Vue();
Vue.prototype.$evt = evt;

Vue.component('IndexPage', require('./components/AppIndex.vue'));
Vue.component('AddPage', require('./components/AppAdd.vue'));

const app = new Vue({
    el: '#app'
});
