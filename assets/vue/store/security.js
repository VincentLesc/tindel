import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        isAuthenticated: false,
        userId : null
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        isAuthenticated (state) {
            return state.isAuthenticated;
        },
        userId (state) {
            return state.userId;
        }
    },
    mutations: {
        ['AUTHENTICATION_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = true;
            state.userId = payload.id;
        },

        ['AUTHENTICATION_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.isAuthenticated = false;
            console.log(error)
        },
        ['PROVIDING_DATA_ON_REFRESH_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.hasError = null;
            state.error = null;
            state.isAuthenticated = payload.isAuthenticated;
        }
    },
    actions: {
        registerUser({commit}, payload ) {
            return SecurityAPI.register(payload.email, payload.plainPassword)
                .then(res => commit('AUTHENTICATION_SUCCESS', res.data))
                .catch(error => commit('AUTHENTICATION_ERROR', error))
        },
        onRefresh({commit}, payload) {
            commit('PROVIDING_DATA_ON_REFRESH_SUCCESS', payload);
        },
        loginUser({commit}, payload) {
            return SecurityAPI.login(payload.email, payload.plainPassword)
                .then(res => commit('AUTHENTICATION_SUCCESS', res.data))
                .catch(res => commit('AUTHENTICATION_ERROR', res))

        },
    },
}
