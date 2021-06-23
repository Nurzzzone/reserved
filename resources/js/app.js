import { createApp } from 'vue'

import App from './app/App'
import router from './router/router'
import Maska from 'maska'

const app = createApp(App).use(router);
app.use(Maska);
app.mount('#app');
require('./bootstrap');
