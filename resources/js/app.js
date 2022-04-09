import { createApp, h } from 'vue'
import RootComponent from './Components/Root.vue'


window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(RootComponent).mount('#app')