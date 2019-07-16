import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store';
import { Datetime } from 'vue-datetime';
import Vuetify from 'vuetify';

import 'vuetify/dist/vuetify.min.css'

Vue.component('datetime', Datetime);
Vue.use(Vuetify);

new Vue({
    template: '<App/>',
    components: { App },
    router,
    store
}).$mount('#app');
