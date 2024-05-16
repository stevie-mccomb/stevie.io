import './bootstrap';
import '../scss/app.scss';

import { createApp, ref } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from '@/components/App.vue';
import routes from '@/routes';

window.app = createApp(App);

window.router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { top: 0 };
    },
});

app.use(router);

app.mount('#app');
