<<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title class="pb-0">
            <v-toolbar-title class="text-capitalize">
                <v-icon>security</v-icon>
                {{ $tc('lang.module.role', 2) }}
            </v-toolbar-title>
            
            <v-divider class="mx-2" inset vertical></v-divider>

            <v-btn v-if="$can('role.create')" color="primary" dark class="mb-2" :to="{ name: 'roles.create' }">{{ $t('lang.action.new') }} {{ $tc('lang.module.role') }}</v-btn>
            
            <v-spacer></v-spacer>
            
            <v-text-field v-model="search" append-icon="search" :label="$t('lang.action.search')" single-line hide-details></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="data" :search="search" v-if="!loading" :disable-initial-sort="true"
            :rows-per-page="10" :rows-per-page-items="[10, 25, 50, 100]">
            <template v-slot:items="props">
                <td>{{ props.item.name }}</td>
                <td>{{ props.item.slug }}</td>
                <td>{{ props.item.description }}</td>
                <td>{{ props.item.level }}</td>
                <td>{{ props.item.created_at }}</td>
                <td align="right">
                    <dt-action :attr="attr" :row="props.item"></dt-action>
                </td>
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
                { text: 'Name', value: 'name', align: 'left' },
                { text: 'Slug', value: 'email' },
                { text: 'Description', value: 'status' },
                { text: 'Level', value: 'level' },
                { text: 'Created At', value: 'created_at'},
                { text: 'Actions', value: 'action', sortable: false}
            ],
            attr: {
                module: 'Roles',
                permission: 'role',
                route: 'roles'
            }
        }),
        created () {
            this.fetchData()
        },
        destroyed() {
            this.resetState()
        },
        computed: {
            ...mapGetters('Roles', ['data', 'loading']),
        },
        methods: {
            ...mapActions('Roles', ['fetchData', 'destroyData', 'resetState']),
        }
    }
</script>