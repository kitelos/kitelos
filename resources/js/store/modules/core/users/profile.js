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
    loading: false
  }
}

const getters = {
  item: state => state.item,
  loading: state => state.loading,
}

const actions = {
  fetchData({ commit }, id) {
    $http.get('/api/core/profile/' + id)
      .then(response => {
        commit('setItem', response.data.data)
      })
      .catch(error => {
        let message = error.response.data.message || error.message
        this.$eventHub.$emit('message', 'error', 'error', message)
      })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = Helper.loadParams(state.item, true)
          
      $http.post('/api/core/profile/' + state.item.id, params)
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
  setPhoto({ commit }, value) {
    commit('setPhoto', value)
  },
  setStatus({ commit }, value) {
    commit('setStatus', value)
  },
  resetState({ commit }) {
    commit('resetState')
  },
}

const mutations = {
  setItem (state, item) {
    state.item = item
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
  setPhoto(state, value) {
    state.item.photo = value
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
