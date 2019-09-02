<template>
    <v-list dense>
        <v-list-group prepend-icon="keyboard_arrow_down" append-icon="">
            <v-list-tile slot="activator" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ auth.alias }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile :to="{ name: 'users.profile' }" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                <v-list-tile-action>
                    <v-icon>person</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ $t('lang.profile') }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile :href="$api.domain+'logout'" @click="logout" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                <v-list-tile-action>
                    <v-icon>input</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ $t('lang.logout') }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <form id="logout-form-one" :action="$api.domain + 'logout'" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </v-list-group>
        <template v-for="item in items">
            <v-layout row v-if="item.heading" align-center :key="item.heading" >
                <v-flex xs6>
                    <v-subheader v-if="item.heading">
                        {{ $tc('lang.module.' + item.heading, 2) }}
                    </v-subheader>
                </v-flex>
                <v-flex xs6 class="text-xs-right">
                    <v-btn small flat>edit</v-btn>
                </v-flex>
            </v-layout>
            
            <v-divider v-else-if="item.divider" dark class="my-3" :key="item.id"></v-divider>

            <v-list-group v-else-if="item.children" v-model="item.model" :key="item.text" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
                <v-list-tile slot="activator" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.localizable ? $tc('lang.module.' + item.text, 2) : item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile v-for="(child, i) in item.children" :key="i" :href="child.external ? child.route : ''" :to="child.external ? '' : {name: child.route }" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                    <v-list-tile-action v-if="child.icon">
                        <v-icon>{{ child.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ child.localizable ? $t('lang.' + child.text) : child.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list-group>

            <v-list-tile v-else-if="item.external" target="_blank" :href="item.route" :key="item.text" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title class="text-capitalize">
                        {{ item.localizable ? $tc('lang.module.' + item.text, 2) : item.text }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile v-else-if="item.permission ? $can(item.permission) : true" :to="{ name: item.route ? item.route : '' }" :key="item.text" :class="$theme.drawer.text.normal" :active-class="$theme.drawer.text.active">
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title class="text-capitalize">
                        {{ item.localizable ? $tc('lang.module.' + item.text, 2) : item.text }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </template>
    </v-list>
</template>

<script>

import menu from '@conf/menu'

export default {
    /*props: {
        auth: Object
    },*/
    data : () => ({
        auth: Object,
        items: [],
        csrf: '',
    }),
    mounted () {
        this.csrf = window.axios.defaults.headers.common['X-CSRF-TOKEN']
    },
    created () {
        this.auth = window.auth
        this.generateMenu();
    },
    methods: {
        logout: function () {
            event.preventDefault();
            document.getElementById('logout-form-one').submit();
        },
        generateMenu: function () {
            this.items = menu
        }
    }
}
</script>