function initialState() {
    return {
        message             :   null,
        errors_validation   :   null,
        type                :   'success'
    }
}

const getters = {
    message:    state => state.message,
    type:       state => state.color,
    errors_validation:     state => state.errors_validation
}

const actions = {
    setMessage({ commit }, message) {
        commit('setMessage', message)
    },
    
    setErrors({ commit }, errors) {
        commit('setErrors', errors)
    },
    
    setColor({ commit }, type) {
        commit('setType', type)
    },
    
    setAlert({ commit }, data) {
        commit('setMessage', data.message || null)
        commit('setErrors', data.errors || null)
        commit('setType', data.type || null)
    },

    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setMessage(state, message) {
        state.message = message
    },
    setErrors(state, errors) {
        state.errors_validation = errors
    },
    setType(state, type) {
        state.type = type || 'success'
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
