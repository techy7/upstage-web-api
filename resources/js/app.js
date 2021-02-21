/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));

// var firebase = require('firebase/app');

// firebase.initializeApp({
// 	apiKey: "AIzaSyDzmCiE8xQV7bnrcfdBJi5h55DDddX56vc",
// 	authDomain: "apertr-upstage.firebaseapp.com",
// 	databaseURL: "https://apertr-upstage.firebaseio.com",
// 	projectId: "apertr-upstage",
// 	storageBucket: "apertr-upstage.appspot.com",
// 	messagingSenderId: "77943000085",
// 	appId: "1:77943000085:web:7bfae79c05cc665277921c",
// 	measurementId: "G-M6248ND222"
// });
// firebase.analytics();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

require('./component-paths');  

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
