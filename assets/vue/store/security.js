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
            state.hasError = null;
            state.error = null;
            state.isAuthenticated = true;
            state.userId = payload.id;
            console.log(state);
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
        },
        onRefresh({commit}, payload) {
            commit('PROVIDING_DATA_ON_REFRESH_SUCCESS', payload);
        },
        loginUser({commit}, payload) {
            return SecurityAPI.login(payload.email, payload.plainPassword)
                .then(res => commit('AUTHENTICATION_SUCCESS', res.data))
        },
    },
}
