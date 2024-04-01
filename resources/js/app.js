import './bootstrap';
import '../scss/app.scss';

import { createApp, ref } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from '@/components/App.vue';
import routes from '@/routes';

window.app = createApp(App);
window.router = createRouter({
    history: createWebHistory(),
    routes
});

app.use(router);

app.mount('#app');
