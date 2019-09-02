require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$eventHub = new Vue()

import API from './API'
Vue.prototype.$api = API

import BASE from './config/base'
Vue.prototype.$base = BASE

import THEME from './config/theme'
Vue.prototype.$theme = THEME

import router from './routes/index'
import store from './store'

import httpPlugin from './plugins/http/index'
window.$http = httpPlugin

import permissPlugin from './plugins/permiss/index'
Vue.use(permissPlugin)

import i18n from './lang'
import veeconfig from './config/validate'
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate, veeconfig)

import Helper from './Helper'
window.Helper = new Helper()

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import Vuetify from 'vuetify'
Vue.use(Vuetify, {
    theme: THEME
})

Vue.component('alert-component', require('#/Alert.vue').default)
Vue.component('drawer-menu-left', require('#/DrawerMenu.vue').default)
Vue.component('template-admin', require('#/AdminLayout.vue').default)
Vue.component('event-hub', require('#/EventHub.vue').default)

const app = new Vue({
    data: {
        base: 'base data',
        user: null
    },
    router,
    store,
    i18n,
    mounted() {
        this.checkPermission()
    },
    watch: {
        '$route': function() {
            this.checkPermission()
        }
    },
    methods: {
        checkPermission () {
            this.$eventHub.$emit('permiss')
        }
    }
}).$mount('#app')