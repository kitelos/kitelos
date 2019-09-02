<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>settings</v-icon>
                {{ $tc('lang.action.show') }} {{ $tc('lang.module.setting', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation="">
                <v-container>
                    <v-layout wrap>
                        <v-flex xs12 md12 d-flex>
                            <v-text-field name="key" :label="$t('lang.forms.key')" type="text" 
                                :value="item.key" disabled>
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md12 d-flex>
                            <v-textarea name="value" :label="$t('lang.forms.value')" 
                                :value="item.value" disabled>
                            </v-textarea>
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
        ...mapGetters('SettingsSingle', ['item', 'loading'])
    },
    methods: {
        ...mapActions('SettingsSingle', ['fetchData', 'resetState']),
    }
}
</script>