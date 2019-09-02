function initialState() {
    return {
        item: {
            id: null,
            name: null,
            slug: null,
            level: 1,
            description: ''
        },
        loading: false
    }
}

const getters = {
    item:           state => state.item,
    loading:        state => state.loading,
}

const actions = {
    fetchData({ commit}, id) {
        $http.get('/api/core/roles/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                this.$eventHub.$emit('message', 'error', 'error', message)
            })
    },
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)

        return new Promise((resolve, reject) => {
            let params = Helper.loadParams(state.item, false)

            $http.post('/api/core/roles', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch('Alert/setAlert',
                        { message: message, errors: errors, type: 'error' },
                        { root: true })

                    reject(errors)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)

        return new Promise((resolve, reject) => {
            let params = Helper.loadParams(state.item, true)

            $http.post('/api/core/roles/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch('Alert/setAlert',
                        { message: message, errors: errors, type: 'error' },
                        { root: true })

                    reject(errors)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchPermissions({ commit}, id) {
        $http.get('/api/core/permissions')
            .then(response => {
                commit('setPermissions', response.data.data)
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                this.$eventHub.$emit('message', 'error', 'error', message)
            })
    },

    setName({ commit }, value) {
        commit('setName', value)
    },
    setSlug({ commit }, value) {
        commit('setSlug', value)
    },
    setLevel({ commit }, value) {
        commit('setLevel', value)
    },
    setDescription({ commit }, value) {
        commit('setDescription', value)
    },

    resetState({ commit }) {
        commit('resetState')
    },
}

const mutations = {
    setItem (state, item) {
        state.item = item
    },
    setLoading (state, loading) {
        state.loading = loading
    },

    setName(state, value) {
        state.item.name = value
        state.item.slug = Helper.slugify(value)
    },
    setSlug(state, value) {
        state.item.slug = value
    },
    setLevel(state, value) {
        state.item.level = value
    },
    setDescription(state, value) {
        state.item.description = value
    },
    resetState (state) {
        state = Object.assign(state, initialState())
    },
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
