/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import Slick from 'vue-slick';
import store from './store.js'

import VModal from 'vue-js-modal';
Vue.use(VModal);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('news-component', require('./components/NewsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // el: '#app',
    components: { Slick },
    el: '#app',
    store,
    data: {
        //メイン
        slickOptions: {
            slidesToShow: 1,
            arrows: true,
            centerMode: true,
            initialSlide: 1,
            centerPadding: '10%',
            asNavFor: '.slider-nav',
        },
        //サムネイル
        slickNavOptions: {
            slidesToShow: 5,
            asNavFor: '.slider-for',
            focusOnSelect: true,
        },
    },
    methods: {
  	        show : function(i) {
  	            console.log("show")
                console.log(i)
                this.$modal.show('hello-world');
            },
            hide : function () {
                this.$modal.hide('hello-world');
            },
        }, 
});
