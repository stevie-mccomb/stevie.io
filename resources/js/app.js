import './bootstrap';
import '../scss/app.scss';

import { createApp } from 'vue';
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

window.router.beforeEach((to, from) => {
    document.title = (!!to.meta.title) ? `${to.meta.title} | Stevie McComb` : 'Stevie McComb';
});

window.app.use(window.router);

window.app.mount('#app');
