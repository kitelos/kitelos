import Vue from 'vue'
import Vuex from 'vuex'

import Rules from './rules'
import Alert from './alert'

import Users from './modules/core/users'
import UsersSingle from './modules/core/users/single'
import Profile from './modules/core/users/profile'

import Roles from './modules/core/roles'
import RolesSingle from './modules/core/roles/single'
import Permissions from './modules/core/permissions'

import Settings from './modules/core/settings';
import SettingsSingle from './modules/core/settings/single'

/*__STORE_BLOCK_IMPORT__*/

const debug = process.env.NODE_ENV !== 'production'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        Rules,
        Alert,

        Users,
        UsersSingle,
        Profile,
        Roles,
        RolesSingle,
        Permissions,

        Settings,
        SettingsSingle,

        /*__STORE_BLOCK_MODULES__*/
    },
    strict: debug
});