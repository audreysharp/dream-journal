
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

// Event bus to emit events between child and parent
const evt = new Vue();
Vue.prototype.$evt = evt;

// Add route components
Vue.component('app-index', require('./components/AppIndex.vue'));
Vue.component('app-add', require('./components/AppAdd.vue'));
Vue.component('app-view', require('./components/AppView.vue'));

const app = new Vue({
    el: '#app'
});
