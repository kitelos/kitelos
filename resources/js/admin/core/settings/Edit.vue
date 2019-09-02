<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>settings</v-icon>
                {{ $tc('lang.action.update') }} {{ $tc('lang.module.setting', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form">
                <v-container fluid grid-list-xl>
                    <v-layout wrap>
                        <v-flex xs12 md12 d-flex>
                            <v-text-field v-validate="'required|min:3|max:100'" :counter="100" 
                                :error-messages="errors.collect('key')" data-vv-name="key" name="key" 
                                :label="$t('lang.forms.key')" type="text" :value="item.key" @input="updateKey">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md12 d-flex>
                            <v-textarea v-validate="'required|min:3'" :error-messages="errors.collect('value')" 
                                data-vv-name="value" name="value" :label="$t('lang.forms.value')" :value="item.value" @input="updateValue">
                            </v-textarea>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'settings.index' }" color="white">
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
        select: {}
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
        ...mapActions('SettingsSingle', ['fetchData', 'updateData', 'setKey', 'setValue', 'resetState']),
        validate () {
            this.$validator.validate().then(valid => {
                if (valid) this.submitForm()
            });
        },
        updateKey: function (e) {
            this.setValue(e)
        },
        updateValue: function (e) {
            this.setValue(e)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'settings.index' })
                    this.$eventHub.$emit('message')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
    }
}
</script>
