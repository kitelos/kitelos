function initialState() {
    return {
        all: [],
        loading: false,
    }
}

const getters = {
    data: state => {
        let rows = state.all
        return rows
    },
    loading:       state => state.loading
}

const actions = {
    fetchData({ commit, state }) {
        commit('setLoading', true)
        $http.get('/api/core/settings')
            .then(response => {
                commit('setAll', response.data.data)
            })
            .catch(error => {
                let message = error.response.data.message || error.message
                this.$eventHub.$emit('message', 'error', 'error', message)
                console.log(message)
            })
            .finally(() => {
                commit('setLoading', false)
            })
    },
    destroyData({ commit, state }, id) {
        return new Promise((resolve) => {
            $http.delete('/api/core/settings/' + id)
                .then(response => {
                    if (response.data.code == 204) {
                        commit('setAll', state.all.filter((item) => {
                            return item.id != id
                        }))
                    }

                    resolve(response)
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    this.$eventHub.$emit('message', 'error', 'error', message)
                })
            })
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setAll(state, items) {
        state.all = items
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
