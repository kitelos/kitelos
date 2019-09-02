<template>
    <v-alert v-if="message"
        :value="true"
        :color="type" icon="warning">
        {{ message }}
        <ul v-if="errors_validation">
            <li v-for="(value, key) in errors_validation" :key="key">
                {{ value[0] }}
            </li>
        </ul>
    </v-alert>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    computed: {
        ...mapGetters('Alert', ['message', 'errors_validation', 'type']),
        
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
        }
    },
    methods: {
        ...mapActions('Alert', ['resetState'])
    }
}
</script>


<style scoped>
.row-alert {
    padding: 10px;
}
</style>
