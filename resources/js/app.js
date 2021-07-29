require('./bootstrap');

import { createApp } from 'vue';

import App from './app/App';
import router from './router/router';
import Maska from 'maska';
import ReactiveStorage from "vue-reactive-localstorage";

const app = createApp(App).use(router);
app.use(Maska);
app.use(ReactiveStorage, {
    token: '',
    user: '',
    auth: true,
    modal: false,
    favorite: [],
    city: '',
    notifications: [],
    booking: '',
    sidebar: {
        show: false,
        view: 0,
        notifications: 0,
    }
});

app.mount('#app');
