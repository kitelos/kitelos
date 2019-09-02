<<template>
    <v-card>
        <v-progress-linear v-if="loading" :color="$theme.header.right" :indeterminate="true"></v-progress-linear>
        <v-card-title class="pb-0">
            <v-toolbar-title class="text-capitalize">
                <v-icon>people</v-icon>
                {{ $tc('lang.module.user', 2) }}
            </v-toolbar-title>
            
            <v-divider class="mx-2" inset vertical></v-divider>

            <v-btn color="primary" dark class="mb-2" :to="{ name: 'users.create' }">
                {{ $t('lang.action.new') }} {{ $tc('lang.module.user') }}
            </v-btn>
            
            <v-spacer></v-spacer>
            
            <v-text-field v-model="search" append-icon="search" :label="$t('lang.action.search')" single-line hide-details></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="data" :search="search" v-if="!loading" :disable-initial-sort="true"
            :rows-per-page="10" :rows-per-page-items="[10, 25, 50, 100]" :expand="expand">
            <template v-slot:items="props">
                <tr @click="props.expanded = !props.expanded">
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.email }}</td>
                    <td>{{ props.item.status }}</td>
                    <td>{{ props.item.created_at }}</td>
                    <td align="right">
                        <dt-action :attr="attr" :row="props.item"></dt-action>
                    </td>
                </tr>
            </template>
            <template v-slot:expand="props">
                <v-card flat>
                    <v-card-text>
                        {{ $tc('lang.forms.roles') }}: 
                        <span v-for="role in props.item.role" tabindex="-1" class="v-chip v-chip--select-multi theme--light">
                            <span class="v-chip__content">{{ role.name }}</span>
                        </span>
                    </v-card-text>
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
            expand: false,
            search: '',
            headers: [
                { text: 'Name', align: 'left', sortable: true, value: 'name' },
                { text: 'Email', value: 'email' },
                { text: 'Status', value: 'status' },
                { text: 'Created At', value: 'created_at' },
                { text: 'Actions', value: 'action', sortable: false}
            ],
            attr: {
                module: 'Users',
                permission: 'user',
                route: 'users'
            }
        }),
        created () {
            this.fetchData()
        },
        destroyed() {
            this.resetState()
        },
        computed: {
            ...mapGetters('Users', ['data', 'loading']),
        },
        methods: {
            ...mapActions('Users', ['fetchData', 'destroyData', 'resetState']),
        }
    }
</script>