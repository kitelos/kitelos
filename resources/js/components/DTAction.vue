<template>
    <div>
        <v-btn v-if="$can(attr.permission + '.show')" :to="{ name: this.attr.route + '.show', params: { id : row.id } }" flat small icon :color="$theme.dtable.show">
            <v-icon>visibility</v-icon>
        </v-btn>
        <v-btn v-if="$can(attr.permission + '.edit')" :to="{ name: this.attr.route + '.edit', params: { id : row.id } }" flat small icon :color="$theme.dtable.edit">
            <v-icon>edit</v-icon>
        </v-btn>
        <v-btn v-if="$can(attr.permission + '.delete') && row.deleted"
            @click="destroyData(row.id)" flat small icon :color="$theme.dtable.delete">
            <v-icon>delete</v-icon>
        </v-btn>
   </div>
</template>


<script>
export default {
    props: ['attr', 'row'],
    methods: {
        destroyData(id) {
            this.$swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#C62828',
                focusCancel: true,
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                    this.$store.dispatch(this.attr.module + '/destroyData', id)
                        .then(response => {
                            console.log(response.data.data)
                            if ( response.data.code == 204 )
                                this.$eventHub.$emit('message')
                            else 
                                this.$eventHub.$emit('message', 'error', 'error')
                        })
                }
            })
        }
    }
}
</script>