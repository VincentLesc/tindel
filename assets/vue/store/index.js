import Vue from 'vue';
import Vuex from 'vuex';
import PostModule from './post';
import SecurityModule from './security';
import UserModule from './userProfile';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        security: SecurityModule,
        post: PostModule,
        userProfile: UserModule

    }
});
