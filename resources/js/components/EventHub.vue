<template>
    <notifications group="foo"
                   position="top right"
                   :speed="500" :duration="3000" />
</template>
<script>
import { mapGetters }   from 'vuex'
import Vue              from 'vue'
import Notifications    from 'vue-notification'
Vue.use(Notifications)

export default {
    props: {
        auth: Object
    },
    created() {
        this.$eventHub.$on('message', this.message)
        this.rulesUpdate()
        this.$eventHub.$on('rules-update', this.rulesUpdate)
    },
    methods: {
        
        /**
         * model : created | updated | deleted
         * type  : success, warning, error, info
         * msg   : string message
         */
        message(model = 'created', type = 'success', msg = '' ) {
            this.$notify({
                group: 'foo',
                title: this.getTitle(type),
                type: type,
                text: msg.length > 0 ? msg : this.$t('lang.msg.' + model)
            });
        },
        getTitle: function (type) {
            switch ( type ) {
                case 'success': return '<i aria-hidden="true" class="v-icon material-icons white--text" style="font-size:16px">check_circle</i> <strong>SUCCESS</strong>';
                case 'warning': return '<i aria-hidden="true" class="v-icon material-icons white--text" style="font-size:16px">warning</i> <strong>WARNING</strong';
                case 'error': return '<i aria-hidden="true" class="v-icon material-icons white--text" style="font-size:16px">error</i> <strong>ERROR</strong>';
                default: return '<i aria-hidden="true" class="v-icon material-icons white--text" style="font-size:16px">check_circle</i> <strong>INFO</strong>'
            }
        },

        rulesUpdate() {
            if (this.auth) {
                window.Vue.updatePermiss(this.auth.rules)
                window.auth  = this.auth
            }
        }
    }
}
</script>

<style>
    .vue-notification {
        margin: 0 0 5px 5px!important;
        box-shadow: -1px 2px 5px #0000009e;
    }
    .notifications {
        top: 65px!important
    }
</style>