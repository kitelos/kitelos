<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>people</v-icon>
                {{ $tc('lang.action.show') }} {{ $tc('lang.module.user', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation="">
                <v-container fluid grid-list-xl>
                    <v-layout align-center justify-space-around wrap>
                        <v-avatar v-if="item.photo" size="120" color="red" class="elevation-10">
                            <img :src="item.photo" :alt="item.alias">
                        </v-avatar>
                    </v-layout>

                    <v-spacer class="my-3"></v-spacer>

                    <v-layout wrap>
                        <v-flex xs12 md6 d-flex>
                            <v-text-field name="email" :label="$t('lang.forms.email')" type="email" :value="item.email"></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-text-field name="name" :label="$t('lang.forms.name')" type="text" :value="item.name"></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-text-field name="status" :label="$t('lang.forms.status')" type="text" :value="$t('lang.terms.' + item.status)"></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6 d-flex>
                            <v-select
                                :items="item.role"
                                item-text="name"
                                item-value="id"
                                chips
                                :value="item.role"
                                multiple=""
                                disabled=""
                                :label="$t('lang.forms.roles')"></v-select>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'users.index' }" color="white">
                        <v-icon>arrow_back</v-icon> {{ $t('lang.action.back') }}
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
        valid: false,
    }),
    created () {
        this.fetchData(this.$route.params.id)
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
        ...mapGetters('UsersSingle', ['item', 'loading'])
    },
    methods: {
        ...mapActions('UsersSingle', ['fetchData', 'resetState']),
    }
}
</script>