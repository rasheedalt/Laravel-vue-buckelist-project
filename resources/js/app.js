/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router'

require('./bootstrap');

window.Vue = require('vue');



Vue.use(VueRouter);

Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://localhost:8000/api';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('container', require('./components/container.vue').default);
Vue.component('navbar', require('./components/navbar.vue').default);
// Vue.component('bucketlist', require('./components/bucketlist.vue').default);
Vue.component('newbucketlist', require('./components/newbucketlist.vue').default);
// //Vue.component('login', require('./components/login.vue').default);
// Vue.component('register', require('./components/register.vue').default);

import login from './components/login.vue';
import bucketlist from './components/bucketlist.vue';
//import newbucketlist from './components/newbucketlist.vue';
//import navbar from './components/navbar.vue';
import register from './components/register.vue';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//axios.defaults.baseURL = 'http://localhost:8000';

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: login
    }, {
        path: '/register',
        name: 'register',
        component: register,
        meta: {
            auth: false
        }
    }, {
        path: '/login',
        name: 'login',
        component: login,
        meta: {
            auth: false
        }
    }, {
        path: '/dashboard',
        name: 'dashboard',
        component: bucketlist,
        meta: {
            auth: true
        }
    }]
});



//App.router = Vue.router





// const routes = [
//     { path: '/', component: login, meta: { auth: false  } },
//     { path: '/bucketlist', component: require('./components/bucketlist.vue').default, meta: { auth: true  }  },
//     { path: '/bucketlist', component: require('./components/newbucketlist.vue').default },
//     //{ path: '/login', component: require('./components/login.vue').default },
//     { path: '/register', component: require('./components/register.vue').default, meta: { auth: false  }  },
// ]


// const router = new VueRouter({
//      mode: 'history',
//     routes
// });
Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
 });


const app = new Vue({
    el: '#app',
    router
});
