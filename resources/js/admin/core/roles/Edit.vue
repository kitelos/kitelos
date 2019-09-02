<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title>
            <v-toolbar-title class="text-capitalize">
                <v-icon>security</v-icon>
                {{ $tc('lang.action.update') }} {{ $tc('lang.module.role', 1) }}
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-form ref="form">
                <v-container fluid grid-list-xl>
                    <v-layout wrap>
                        <v-flex xs12 md5 d-flex>
                            <v-text-field v-validate="'required|min:3|max:100'" :counter="100" :error-messages="errors.collect('name')" 
                                data-vv-name="name" name="name" :label="$t('lang.forms.name')" type="text" 
                                :value="item.name" @input="updateName">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md5 d-flex>
                            <v-text-field name="slug" :label="$t('lang.forms.slug')" disabled="" type="text" 
                                :value="item.slug">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md2 d-flex>
                            <v-text-field v-validate="'required|between:1,5'" :error-messages="errors.collect('level')" 
                                data-vv-name="level" name="level" :label="$t('lang.forms.level')" type="number" min="1" max="5" 
                                :value="item.level" @input="updateLevel">
                            </v-text-field>
                        </v-flex>
                        <v-flex xs12 md12 d-flex>
                            <v-textarea v-validate="'required|max:255'" :counter="255" :error-messages="errors.collect('description')" 
                                data-vv-name="description" name="description" :label="$t('lang.forms.description')" type="text" 
                                :value="item.description" @input="updateDescription">
                            </v-textarea>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-card-actions>
                    <v-btn :to="{ name: 'roles.index' }" color="white">
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
        ...mapGetters('RolesSingle', ['item', 'loading'])
    },
    methods: {
        ...mapActions('RolesSingle', ['fetchData', 'updateData', 'setName', 'setLevel', 'setDescription', 'resetState']),
        validate () {
            this.$validator.validate().then(valid => {
                if (valid) this.submitForm()
            });
        },
        updateName: function (e) {
            this.setName(e)
        },
        updateLevel: function (e) {
            this.setLevel(e)
        },
        updateDescription: function (e) {
            this.setDescription(e)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'roles.index' })
                    this.$eventHub.$emit('message')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
    }
}
</script>
