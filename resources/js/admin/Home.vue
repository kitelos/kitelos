<template>
    <v-layout row wrap dashboard>
        <v-flex v-if="$can('user.list')" xs12 sm6 md4 pa-1>
            <v-card color="indigo darken-3" class="white--text">
                <v-layout>
                    <v-flex xs5 pa-3>
                        <v-icon class="white--text">group</v-icon>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline text-capitalize">{{ $tc('lang.module.user', 2) }}</div>
                                <div>{{ $t('lang.msg.card.registered') }}</div>
                                <div>{{ users }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider light></v-divider>
                <v-card-actions class="pa-3">
                    <router-link :to="{ name: 'users.index' }" class="white--text">{{ $t('lang.msg.card.action-users') }}</router-link>
                </v-card-actions>
            </v-card>
        </v-flex>

        <v-flex v-if="$can('role.list')" xs12 sm6 md4 pa-1>
            <v-card color="purple darken-3" class="white--text">
                <v-layout>
                    <v-flex xs5 pa-3>
                        <v-icon class="white--text">security</v-icon>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline text-capitalize">{{ $tc('lang.module.role', 2) }}</div>
                                <div>{{ $t('lang.msg.card.registered') }}</div>
                                <div>{{ roles }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider light></v-divider>
                <v-card-actions class="pa-3">
                    <router-link :to="{ name: 'roles.index' }" class="white--text">{{ $t('lang.msg.card.action-roles') }}</router-link>
                </v-card-actions>
            </v-card>
        </v-flex>

        <v-flex v-if="$can('setting.list')" xs12 sm6 md4 pa-1>
            <v-card color="pink darken-2" class="white--text">
                <v-layout align-center justify-center>
                    <v-flex xs5 pa-3>
                        <v-icon class="white--text">settings</v-icon>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline text-capitalize">{{ $tc('lang.module.setting', 2) }}</div>
                                <div>{{ $t('lang.msg.card.registered') }}</div>
                                <div>{{ settings }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider light></v-divider>
                <v-card-actions class="pa-3">
                    <router-link :to="{ name: 'settings.index' }" class="white--text">{{ $t('lang.msg.card.action-settings') }}</router-link>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    extends: 'template-admin',
    data : () => ({
        users: 0,
        roles: 0,
        settings: 0
    }),
    mounted(){
        this.fetchUser()
        this.fetchRole()
        this.fetchSetting()
    },
    methods: {
        fetchUser: function () {
            if ( this.$can('user.list') ) {
                $http.get('/api/core/users')
                    .then(response => {
                        this.users = response.data.data.length 
                    })
                    .catch(error => {
                        let message = error.response.data.message || error.message
                        this.$eventHub.$emit('message', 'error', 'error', message)
                    })
            }
        },
        fetchRole: function () {
            if ( this.$can('role.list') ) {
                $http.get('/api/core/roles')
                    .then(response => {
                        this.roles = response.data.data.length 
                    })
                    .catch(error => {
                        let message = error.response.data.message || error.message
                        this.$eventHub.$emit('message', 'error', 'error', message)
                    })
            }
        },
        fetchSetting: function () {
            if ( this.$can('setting.list') ) {
                $http.get('/api/core/settings')
                    .then(response => {
                        this.settings = response.data.data.length 
                    })
                    .catch(error => {
                        let message = error.response.data.message || error.message
                        this.$eventHub.$emit('message', 'error', 'error', message)
                    })
            }
        }
    }
}
</script>