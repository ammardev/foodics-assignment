import { createApp } from 'vue';
import RootComponent from './Components/Root.vue';
import store from './store';


window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(RootComponent).use(store).mount('#app')