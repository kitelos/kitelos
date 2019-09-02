import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '%/Home'
import Login from '%/Login'


import HomeAdmin from '&/Home.vue'
import Help from '&/Help.vue'

import UsersIndex from '&/core/users/Index'
import UsersCreate from '&/core/users/Create'
import UsersEdit from '&/core/users/Edit'
import UsersShow from '&/core/users/Show'
import UsersProfile from '&/core/users/Profile'

import RolesIndex from '&/core/roles/Index'
import RolesCreate from '&/core/roles/Create'
import RolesEdit from '&/core/roles/Edit'
import RolesShow from '&/core/roles/Show'

import SettingsIndex from '&/core/settings/Index'
import SettingsCreate from '&/core/settings/Create'
import SettingsEdit from '&/core/settings/Edit'
import SettingsShow from '&/core/settings/Show'

Vue.use(VueRouter)

const debug = process.env.NODE_ENV !== 'production'

if (!debug) {
    Vue.config.productionTip    =   false;
    Vue.config.devtools         =   false;
    Vue.config.debug            =   false;
    Vue.config.silent           =   true;
}

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login', component: Login },

    { path: '/admin/home', name: 'dashboard', component: HomeAdmin},
    
    { path: '/admin/users', name: 'users.index', component: UsersIndex,  meta: {
        permission: 'user.list'
    }},
    { path: '/admin/users/create', name: 'users.create', component: UsersCreate, meta: {
        permission: 'user.create'
    }},
    { path: '/admin/users/:id/edit', name: 'users.edit', component: UsersEdit, meta: {
        permission: 'user.edit'
    }},
    { path: '/admin/users/:id', name: 'users.show', component: UsersShow, meta: {
        permission: 'user.show'
    }},
    { path: '/admin/profile', name: 'users.profile', component: UsersProfile, meta: {
        permission: 'user.profile'
    } },


    { path: '/admin/roles', name: 'roles.index', component: RolesIndex, meta: {
        permission: 'role.list'
    }},
    { path: '/admin/roles/create', name: 'roles.create', component: RolesCreate , meta: {
        permission: 'role.create'
    }},
    { path: '/admin/roles/:id/edit', name: 'roles.edit', component: RolesEdit , meta: {
        permission: 'role.edit'
    }},
    { path: '/admin/roles/:id', name: 'roles.show', component: RolesShow , meta: {
        permission: 'role.show'
    }},


    { path: '/admin/settings', name: 'settings.index', component: SettingsIndex, meta: {
        permission: 'setting.list'
    } },
    { path: '/admin/settings/create', name: 'settings.create', component: SettingsCreate, meta: {
        permission: 'setting.create'
    } },
    { path: '/admin/settings/:id/edit', name: 'settings.edit', component: SettingsEdit, meta: {
        permission: 'setting.edit'
    } },
    { path: '/admin/settings/:id', name: 'settings.show', component: SettingsShow, meta: {
        permission: 'setting.show'
    } },
    

    { path: '/admin/help', name: 'help', component: Help }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router