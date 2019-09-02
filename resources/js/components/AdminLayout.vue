<template>
    <v-app id="inspire" :dark="!$base.theme.dark">
        <v-navigation-drawer app dark v-model="drawer" :class="$theme.drawer.background">
            <v-toolbar :color="$theme.header.left" :dark="$base.theme.dark">
                <img :src="$api.domain + 'img/logo.svg'" height="36" :alt="$base.description">
                <v-toolbar-title class="ml-0 pl-3">
                    <span class="hidden-sm-and-down">{{ $base.name }}</span>
                </v-toolbar-title>        
            </v-toolbar>
            <drawer-menu-left :auth="auth"></drawer-menu-left>
        </v-navigation-drawer>
        <v-toolbar :color="$theme.header.right" :dark="$base.theme.dark" :clipped-left="false" app absolute>
            <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
                <v-btn icon large flat slot="activator">
                    <v-avatar size="40px">
                        <img :src="auth.photo" :alt="auth.alias" >
                    </v-avatar>
                </v-btn>
                <v-list class="pa-0">
                    <v-list-tile :to="{ name: 'users.profile' }" ripple="ripple">
                        <v-list-tile-action >
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ $t('lang.profile') }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile :href="$api.domain + 'logout'" @click="logout" ripple="ripple">
                        <v-list-tile-action >
                            <v-icon>input</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ $t('lang.logout') }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <form id="logout-form-two" :action="$api.domain + 'logout'" method="POST" style="display: none;">
                        <input type="hidden" name="_token" :value="csrf">
                    </form>
                </v-list>
            </v-menu>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <slot></slot>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {
    props: {
        auth: Object
    },
    data: () => ({
        dialog: false,
        drawer: null,
        csrf: '',
    }),
    created() {
        this.$eventHub.$on('permiss', this.permiss)
    },
    mounted () {
        this.csrf = window.axios.defaults.headers.common['X-CSRF-TOKEN']
    },
    methods : {
        permiss: function () {
            if (!this.$can( this.$route.meta.permission )) this.$router.push({ name: 'dashboard' })
        },

        logout: function () {
            event.preventDefault();
            document.getElementById('logout-form-two').submit();
        }
    }
}
</script>