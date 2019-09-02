function initialState() {
    return {
        item: {
            id: null,
            alias: null,
            name: null,
            email: null,
            photo: null,
            type: 'web',
            role: [],
            bio: null,
            status: 'enable'
        },
        roles: { },
        loading: false
    }
}

const getters = {
    item: state => state.item,
    roles: state => state.roles,
    loading: state => state.loading,
}

const actions = {
    fetchData({ commit }, id) {
        $http.get('/api/core/users/' + id)
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
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            
            let params = Helper.loadParams(state.item, false) 

            $http.post('/api/core/users', params)
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

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = Helper.loadParams(state.item, true)
            
            $http.post('/api/core/users/' + state.item.id, params)
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

    fetchRoles({ commit}) {
        $http.get('/api/core/roles')
            .then(response => {
                commit('setRoles', response.data.data)
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                this.$eventHub.$emit('message', 'error', 'error', message)
            })
    },

    setName({ commit }, value) {
        commit('setName', value)
    },
    setAlias({ commit }, value) {
        commit('setAlias', value)
    },
    setBio({ commit }, value) {
        commit('setBio', value)
    },
    setEmail({ commit }, value) {
        commit('setEmail', value)
    },
    setStatus({ commit }, value) {
        commit('setStatus', value)
    },
    setRoles({ commit }, value) {
        commit('setRoles', value)
    },
    setRole({ commit }, value) {
        commit('setRole', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
}

const mutations = {
    setItem (state, item) {
        state.item = item
    },
    setRole (state, item) {
        state.item.role = item
    },
    setName(state, value) {
        state.item.name = value
    },
    setAlias(state, value) {
        state.item.alias = value
    },
    setBio(state, value) {
        state.item.bio = value
    },
    setEmail(state, value) {
        state.item.email = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setRoles(state, value) {
        state.roles = value
    },
    setLoading (state, loading) {
        state.loading = loading
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
