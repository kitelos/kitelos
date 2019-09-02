function initialState() {
    return {
        item: {
            id: null,
            key: null,
            value: null
        },
        loading: false
    }
}

const getters = {
    item:           state => state.item,
    loading:        state => state.loading,
}

const actions = {
    updateItem ({commit}, item) {
        commit('setItem', item);
    },
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)

        return new Promise((resolve, reject) => {
            let params = Helper.loadParams(state.item, false)

            $http.post('/api/core/settings', params)
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

            $http.post('/api/core/settings/' + state.item.id, params)
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
    fetchData({ commit}, id) {
        $http.get('/api/core/settings/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                this.$eventHub.$emit('message', 'error', 'error', message)
            })
    },

    setKey({ commit }, value) {
        commit('setKey', value)
    },
    setValue({ commit }, value) {
        commit('setValue', value)
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

    setKey(state, value) {
        state.item.key = value
    },
    setValue(state, value) {
        state.item.value = value
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
