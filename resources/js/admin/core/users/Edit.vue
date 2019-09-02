<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>people</v-icon>
                {{ $tc('lang.action.update') }} {{ $tc('lang.module.user', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form">
                <v-container fluid grid-list-xl>
                    <v-layout wrap>
                        <v-flex xs12 md6 d-flex>
                            <v-text-field v-validate="'required|min:10|max:150|email'" :counter="150" 
                                :error-messages="errors.collect('email')" data-vv-name="email" name="email" 
                                :label="$t('lang.forms.email')" type="email" :value="item.email" @input="updateEmail">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-text-field v-validate="'required|min:3|max:150'" :counter="150" 
                                :error-messages="errors.collect('name')" data-vv-name="email" name="name" 
                                :label="$t('lang.forms.name')" type="text" :value="item.name" @input="updateName">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-select v-model="select"
                                :items="items" item-text="value" item-value="name" return-object :value="item.status"
                                @input="updateStatus" :label="$t('lang.forms.status')">
                            </v-select>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-select
                                v-validate="'required'" :error-messages="errors.collect('roles')" 
                                data-vv-name="roles" :items="roles" item-text="name" item-value="id" chips
                                return-object :value="item.role" @input="updateRole" multiple :label="$t('lang.forms.roles')">
                            </v-select>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'users.index' }" color="white">
                        <v-icon>clear</v-icon> {{ $t('lang.action.cancel') }}
                    </v-btn>
                    <v-btn color="primary" dark @click="validate">
                        <v-icon>save</v-icon> {{ $t('lang.action.update') }}
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
        items: [],
        select: {}
    }),
    created () {
        this.fetchData(this.$route.params.id)
        this.items = [
            { name: 'enable', value: this.$t('lang.terms.enable') },
            { name: 'disable', value: this.$t('lang.terms.disable') }
        ]

        this.fetchRoles()
        
        this.select = Helper.stateValue(this.item.status, 
            [this.$t('lang.terms.enable'), 
                this.$t('lang.terms.disable')])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    destroyed () {
        this.resetState()
    },
    computed: {
        ...mapGetters('UsersSingle', ['item', 'roles', 'loading'])
    },
    methods: {
        ...mapActions('UsersSingle', ['fetchData', 'fetchRoles', 'updateData', 'setName', 'setEmail', 'setRole', 'setStatus', 'resetState']),
        validate () {
            this.$validator.validate().then(valid => {
                if (valid) this.submitForm()
            });
        },
        updateName: function (e) {
            this.setName(e)
        },
        updateEmail: function (e) {
            this.setEmail(e)
        },
        updateStatus: function (e) {
            this.setStatus(e.name)
        },
        updateRole: function (e) {
            this.setRole(e)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'users.index' })
                    this.$eventHub.$emit('message', 'updated')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
    }
}
</script>
