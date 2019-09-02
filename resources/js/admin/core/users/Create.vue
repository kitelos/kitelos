<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>people</v-icon>
                {{ $tc('lang.action.create') }} {{ $tc('lang.module.user', 1) }}
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
                            <v-text-field v-validate="'required|min:3|max:150'" :counter="150" :error-messages="errors.collect('name')" 
                                data-vv-name="name" name="name" :label="$t('lang.forms.name')" type="text"
                                :value="item.name" @input="updateName">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-select v-model="select"
                                :items="items"
                                item-text="value"
                                item-value="name"
                                return-object
                                chips=""
                                :value="item.status"
                                @input="updateStatus"
                                :label="$t('lang.forms.status')"></v-select>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-select
                                v-validate="'required'" :error-messages="errors.collect('roles')" 
                                data-vv-name="roles"
                                :items="roles"
                                item-text="name"
                                item-value="id"
                                chips
                                :value="item.role"
                                @input="updateRole"
                                multiple=""
                                :label="$t('lang.forms.roles')"></v-select>
                        </v-flex>
                        <v-flex xs12 md12 d-flex>
                            <v-alert :value="true" type="info" outline>
                                {{ $t('lang.msg.default_password') }}
                            </v-alert>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'users.index' }" color="white">
                        <v-icon>clear</v-icon> {{ $t('lang.action.cancel') }}
                    </v-btn>
                    <v-btn color="primary" dark @click="validate">
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
        items: [],
        select: {},
    }),
    created () {
        this.items = [
            { name: 'enable', value: this.$t('lang.terms.enable') },
            { name: 'disable', value: this.$t('lang.terms.disable') }
        ]
        this.select = { name: 'enable', value: this.$t('lang.terms.enable') }
        this.fetchRoles()
    },
    destroyed () {
        this.resetState()
    },
    computed: {
        ...mapGetters('UsersSingle', ['item', 'roles', 'loading'])
    },
    methods: {
        ...mapActions('UsersSingle', ['storeData', 'fetchRoles', 'setName', 'setEmail', 'setStatus', 'setRole', 'resetState']),
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
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'users.index' })
                    this.$eventHub.$emit('message')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
    }
}
</script>
