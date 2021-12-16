require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
//import Router from 'vue-router';
import VueTranslate from 'vue-translate-plugin';
Vue.use(VueTranslate);

// We import JQuery
const $ = require('jquery');
// We declare it globally
window.$ = $;


Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('not-found', require('./components/NotFound.vue').default);

import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

import VueSpinners from 'vue-spinners'

Vue.use(VueSpinners)


Vue.locales({
    ar: {
        // products
        'products': 'المنتجات',
        'all_products': 'كل المنتجات',
        'add_products': 'أضافة منتج',
        'edit_products': 'تعديل منتج',
        'product_name': 'أسم المنتج',
        'product_cat': 'قسم المنتج',
        'product_price': 'سعر المنتج',
        'q_totalquantity': 'أجمالي كمية المنتج',
        'quantity': 'الكمية',

        // another translate
        'Are_you_sure?': 'هل أنت متأكد؟',
        "You_won't_be_able_to_revert_this!": 'لا يمكنك ارجاع البيانات مرة اخري !',
        'Yes_delete_it!': 'نعم أحذفه',
        'cancel': 'الغاء',
        'add': 'أضف',
        'edit': 'تعديل',
        'search': 'بحث',
        'action': 'العمليات',
        'active': 'نشط',
        'deactive': 'غير نشط',
    },
    en: {
         // products
         'products': 'Products',
         'all_products': 'All Products',
         'add_products': 'Add Product',
         'edit_products': 'Edit Product',
         'product_name': 'Product Name',
         'product_cat': 'Product Category',
         'product_price': 'Product Price',
         'quantity': 'Product Total Quantity',


        //another translates
        'Are_you_sure?': 'Are you sure?',
        "You_won't_be_able_to_revert_this!": "You won't be able to revert this!",
        'Yes_delete_it!': 'Yes, delete it!',
        'cancel': 'cancel',
        'search': 'search',
        'add': 'Add',
        'edit': 'Edit',
        'action': 'Actions',
        'active': 'Active',
        'deactive': 'DeActive',

    },
});



//import ExampleComponent from './components/ExampleComponent.vue'
Vue.use(VueRouter);

//sweetalert2
import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
});
window.Fire = new Vue();

window.Toast = Toast;
//notification
import Notification from "./Helpers/Notification";
window.Notification = Notification;

import _ from 'lodash';

// globally onreload
window.Reload = new Vue();
//import user helpers
import User from "./Helpers/User";
window.User = User;
import { routes } from './routes';
import moment from 'moment'
Vue.filter('myDate', function (v) {
    return moment(v).format('MMMM Do YYYY');
});

Vue.filter('myTime', function (v) {
    return moment(v, "HH:mm").format('hh:mm A');
});

const router = new VueRouter({
    mode: 'history',
    routes,


});
const app = new Vue({
    el: '#app',
    router,
    mounted: function () {
        // `this` points to the vm instance
        this.$translate.setLang(locate);
    },



}).$mount('#app');
