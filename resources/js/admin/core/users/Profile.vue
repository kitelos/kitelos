<template>
    <div>  
        <v-container fill-height fluid grid-list-xl>
            <v-layout justify-center wrap>
                <v-flex xs12 md8>
                    <v-card color="white" title="Edit Profile" text="Complete your profile">
                        <v-form ref="form">
                            <v-container fluid grid-list-xl>
                                <v-layout wrap>
                                    <v-flex xs12 md12 d-flex>
                                        <v-text-field v-validate="'required|min:10|max:150|email'" :counter="150" 
                                            :error-messages="errors.collect('email')" data-vv-name="email" :label="$t('lang.forms.email')" 
                                            type="email" :value="item.email" @input="updateEmail">
                                        </v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md5 d-flex>
                                        <v-text-field v-validate="'required|min:3|max:25'" :counter="25" 
                                            :error-messages="errors.collect('alias')" data-vv-name="alias" :label="$t('lang.forms.alias')" 
                                            type="text" :value="item.alias" @input="updateAlias">
                                        </v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md7 d-flex>
                                        <v-text-field v-validate="'required|min:3|max:150'" :counter="150" :error-messages="errors.collect('name')" 
                                            data-vv-name="name" :label="$t('lang.forms.name')" type="text" :value="item.name" @input="updateName">
                                        </v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md12 d-flex>
                                        <v-textarea :label="$t('lang.forms.bio')" :value="item.bio" 
                                            @input="updateBio">
                                        </v-textarea>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <v-card-actions>
                                <v-btn class="ml-2" color="primary" dark @click="validate">
                                    <v-icon class="mr-1">save</v-icon> {{ $t('lang.action.update') }}
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                    <v-card color="white" title="Chage Password" text="Complete fields" class="mt-3">
                        <v-form ref="form">
                            <v-container fluid grid-list-xl>
                                <v-layout wrap>
                                    <v-flex xs12 md6 d-flex>
                                        <v-text-field required :label="$t('lang.forms.password')" type="password" 
                                            v-model="password">
                                        </v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6 d-flex>
                                        <v-text-field required :label="$t('lang.forms.password_confirmation')" 
                                            type="password" v-model="password_confirmation">
                                        </v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <v-card-actions>
                                <v-btn class="ml-2" color="primary" dark @click="changePassword">
                                    <v-icon class="mr-1">sync</v-icon> {{ $t('lang.action.change_password') }}
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-flex>
                <v-flex xs12 md4>
                    <v-card class="v-card-profile">
                        <v-card-text>
                            <div class="text-xs-center">
                                <avatar-upload field="avatar"
                                    @crop-success="cropSuccess"
                                    @crop-upload-success="cropUploadSuccess"
                                    @crop-upload-fail="cropUploadFail"
                                    v-model="show"
                                    :params="params"
                                    :headers="headers"
                                    url="/api/core/profile"
                                    :width="200"
                                    :height="200"
                                    lang-type="es-MX"
                                    :no-rotate="false"
                                    method="POST"
                                    img-format="png">
                                </avatar-upload>
                                <v-avatar slot="offset" class="mx-auto d-block" size="130">
                                    <img :src="item.photo" :alt="item.alias">
                                </v-avatar>
                                <v-btn small round color="prmiary" dark @click="toggleShow" class="mb-3">
                                    <v-icon class="mr-2">cloud_upload</v-icon> {{ $t('lang.msg.profile.upload') }}
                                </v-btn>
                                
                                <v-spacer></v-spacer>
                                <h6 class="category text-gray font-weight-thin uppercase">{{ item.alias }}</h6>
                                <h4 class="card-title mb-3 font-600">{{ item.name }}</h4>
                            </div>
                            <p class="card-description font-weight-light">{{ item.bio }}</p>
                            <v-spacer></v-spacer>
                            <v-chip v-for="(role, i) in item.role" :key="i" color="grey darken-3" outline>
                                <v-avatar class="grey darken-2 white--text">{{ role.name.charAt(0) }}</v-avatar> {{ role.name }}</v-chip>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import myUpload from 'vue-image-crop-upload'

export default {
    components: {
        'avatar-upload': myUpload,
    },
    data : () => ({
        items: [],
        show: false,
        error: false,
        messages: [],
        imgDataUrl: '',
        params: {
            token: window.token,
            name: 'avatar'
        },
        headers: {
            'X-CSRF-TOKEN': window.token,
            'X-Requested-With': 'XMLHttpRequest',
        },
        password: null,
        password_confirmation: null
    }),
    created () {
        this.fetchData(window.auth.id)
    },
    destroyed () {
        this.resetState()
    },
    computed: {
        ...mapGetters('Profile', ['item', 'loading'])
    },
    methods: {
        ...mapActions('Profile', ['fetchData', 'updateData', 'setName', 'setBio', 'setAlias', 'setEmail', 'setPhoto', 'resetState']),
        validate () {
            this.$validator.validate().then(valid => {
                if (valid) this.submitForm()
            });
        },
        updateName: function (e) {
            this.setName(e)
        },
        updateAlias: function (e) {
            this.setAlias(e)
        },
        updateBio: function (e) {
            this.setBio(e)
        },
        updateEmail: function (e) {
            this.setEmail(e)
        },
        updatePassword: function (e) {
            this.setPassword(e)
        },
        updatePasswordConfirmation: function (e) {
            this.setPasswordConfirmation(e)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'users.profile' })
                    this.$eventHub.$emit('message', 'updated')
                })
                .catch((error) => {
                    console.error(error)
                })
        },

        changePassword() {
            let params = new FormData();
            params.set('password', this.password)
            params.set('password_confirmation', this.password_confirmation)
    
            $http.post('/api/core/change/password', params)
            .then(response => {
                this.$store.dispatch('Alert/resetState')
                this.password = null
                this.password_confirmation = null
                this.$router.push({ name: 'users.profile' })
                this.$eventHub.$emit('message', 'updated', 'success', this.$t('lang.msg.profile.change_password'))
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                let errors  = error.response.data.errors
                this.$store.dispatch('Alert/setAlert',
                { message: message, errors: errors, type: 'error' },
                { root: true })
            })
        },

        toggleShow() {
            this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field){
            this.setPhoto(imgDataUrl)
        },
        cropUploadSuccess(jsonData, field){
            this.$eventHub.$emit('message', 'updated', 'success', this.$t('lang.msg.profile.success'))
        },
        cropUploadFail(status, field, ki){
            this.$eventHub.$emit('message', 'updated', 'success', this.$t('lang.msg.profile.error'))
        },
    }
}
</script>