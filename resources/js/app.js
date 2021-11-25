require('./bootstrap');
require('../sass/app.scss')
// import Vue from 'vue'

window.Vue = require('vue').default;

Vue.component('comment-app', require('./components/CommentApp.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});
