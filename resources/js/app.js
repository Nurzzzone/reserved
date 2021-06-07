import { createApp } from 'vue'

import App from './app/App'
import router from './router/router'

createApp(App).use(router).mount('#app');
require('./bootstrap');
