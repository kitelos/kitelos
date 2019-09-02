<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>security</v-icon>
                {{ $tc('lang.action.show') }} {{ $tc('lang.module.role', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation="">
                <v-container fluid grid-list-xl>
                    <v-layout align-center justify-space-around wrap>
                        <v-avatar :color="$theme.header.right" size="60" class="elevation-10">
                            <span class="white--text display-2">{{ item.name ? item.name.charAt(0) : '' }}</span>
                        </v-avatar>
                    </v-layout>
                    <v-layout align-center justify-space-around wrap class="my-2">
                        <h4>{{ item.name }}</h4>
                    </v-layout>

                    <v-spacer class="my-3"></v-spacer>

                    <v-layout wrap>
                        <v-flex xs12 md4 d-flex>
                            <v-text-field :label="$t('lang.forms.slug')" type="text" :value="item.slug" 
                                disabled="">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md4 d-flex>
                            <v-text-field :label="$t('lang.forms.level')" type="text" :value="item.level" 
                                disabled="">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md4 d-flex>
                            <v-text-field :label="$t('lang.forms.created_at')" type="text" :value="item.created_at" 
                                disabled="">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md12 d-flex>
                            <v-text-field :label="$t('lang.forms.description')" :value="item.description" 
                                disabled="">
                            </v-text-field>
                        </v-flex>
                    </v-layout>

                    <v-layout row wrap v-for="(group, iterator) in permissions" :key="iterator">
                        <v-flex xs12 md12 class="title-group">
                            <h5 class="text-uppercase"><b>{{ $t('lang.terms.permission') }} {{ group[0].model }}</b></h5>
                        </v-flex>
                        <v-flex xs12 md4 v-for="(permission, index) in group" :key="index">
                            <v-switch v-model="selected" hide-details="" :label="permission.name +' (' + permission.model + ')'" 
                                :value="permission.id" :color="$theme.header.right">
                            </v-switch>
                        </v-flex>
                    </v-layout>
                    
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'roles.index' }" color="white">
                        <v-icon>arrow_back</v-icon> {{ $t('lang.action.back') }}
                    </v-btn>
                    <v-btn color="primary" dark @click="store">
                        <v-icon>save</v-icon> {{ $t('lang.action.save') }}
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    data : () => ({
        selected: [],
        item: {},
        loading: false,
        permissions: {},
        valid: false
    }),
    created () {
        this.loadData(this.$route.params.id)
        this.loadPermissions()
    },
    methods: {
        loadPermissions: function () {
            this.loading = true
            $http.get('/api/core/permissions')
                .then(response => {
                    this.permissions = response.data.data
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false
                })
        },
        loadData: function (id) {
            this.loading = true
            $http.get('/api/core/roles/' + id)
                .then(response => {
                    this.item = response.data.data
                    this.selected = response.data.permissions
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false
                })
        },
        store: function () {
            this.loading = true
            let params = new FormData();
            params.set('permissions', this.selected)

            $http.post('/api/core/roles/update-permissions/' + this.$route.params.id, params)
                .then(response => {
                    this.$eventHub.$emit('message')
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    this.$eventHub.$emit('message', 'error', 'error', error)
                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
}
</script>

<style scoped>
    .v-input--selection-controls {
        margin-top: 0!important;
        padding-top: 0!important;
    }
    .title-group {
        padding: 20px 12px 0 12px!important
    }
</style>