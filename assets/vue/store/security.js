import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
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
    },
    mutations: {

    },
    actions: {
        registerUser({commit}, login, password ) {
            return SecurityAPI.register(login, password)
                .then(res => console.log(res.data))
        }
    },
}