<<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title class="pb-0">
            <v-toolbar-title class="text-capitalize">
                <v-icon>settings</v-icon>
                {{ $tc('lang.module.setting', 2) }}
            </v-toolbar-title>
            
            <v-divider class="mx-2" inset vertical></v-divider>

            <v-btn color="primary" dark class="mb-2" :to="{ name: 'settings.create' }">{{ $t('lang.action.new') }} {{ $tc('lang.module.setting') }}</v-btn>
            
            <v-spacer></v-spacer>
            
            <v-text-field v-model="search" append-icon="search" :label="$t('lang.action.search')" single-line hide-details></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="data" :search="search" :expand="expand" v-if="!loading" :disable-initial-sort="true"
            :rows-per-page="10" :rows-per-page-items="[10, 25, 50, 100]">
            <template v-slot:items="props">
                <tr @click="props.expanded = !props.expanded">
                    <td>{{ props.item.key }}</td>
                    <td>{{ props.item.created_at }}</td>
                    <td align="right">
                        <dt-action :attr="attr" :row="props.item"></dt-action>
                    </td>
                </tr>
            </template>
            <template v-slot:expand="props">
                <v-card flat>
                    <v-card-text>{{ props.item.value }}</v-card-text>
                </v-card>
            </template>
            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                Your search for "{{ search }}" found no results.
            </v-alert>
        </v-data-table>
    </v-card>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import DTAction from '#/DTAction'

    export default {
        components: {
            'dt-action': DTAction
        },
        data : () => ({
            search: '',
            headers: [
                { text: 'key', align: 'left', sortable: true, value: 'name' },
                { text: 'Created At', value: 'created_at' },
                { text: 'Actions', value: 'action', sortable: false}
            ],
            attr: {
                module: 'Settings',
                permission: 'setting',
                route: 'settings'
            },
            expand: false,
        }),
        created () {
            this.fetchData()
        },
        destroyed() {
            this.resetState()
        },
        computed: {
            ...mapGetters('Settings', ['data', 'loading']),
        },
        methods: {
            ...mapActions('Settings', ['fetchData', 'destroyData', 'resetState']),
        }
    }
</script>