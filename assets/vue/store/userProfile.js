import ProfileAPI from '../api/profile';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        profile: [],
        updated: false
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
        profile (state) {
            return state.profile;
        },
        updated (state) {
            return state.updated;
        }
    },
    mutations: {
        ['FETCHING_PROFILE'](state) {
            state.isLoading = true;
            state.error = null;
            state.updated = false;
        },
        ['FETCHING_PROFILE_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.profile = payload;
            state.updated = false;
        },
        ['UPDATE_PROFILE_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.profile = payload;
            state.updated = true;
        },
    },
    actions: {
        fetchProfile({commit}) {
            commit('FETCHING_PROFILE');
            return ProfileAPI.fetchUserConnectedProfile()
                .then( res => commit('FETCHING_PROFILE_SUCCESS', JSON.parse(res.data)))
        },
        updateProfile({commit}, payload) {
            return ProfileAPI.updateUserConnectedProfile(payload)
                .then(res => commit('UPDATE_PROFILE_SUCCESS', JSON.parse(res.data)))
                .finally(this.state.updated = false);
        }
    }
}
