import AdminProjectCreate from '@/views/admin/projects/Create.vue';
import AdminProjectIndex from '@/views/admin/projects/Index.vue';
import AdminProjectEdit from '@/views/admin/projects/Edit.vue';
import Contact from '@/views/Contact.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/auth/Login.vue';
import Logout from '@/views/auth/Logout.vue';
import e404 from '@/views/errors/e404.vue';
import Project from '@/views/Project.vue';
import ProjectIndex from '@/views/ProjectIndex.vue';

export default [
    /**
     * Error Routes
     */
    { // 404 - Not Found
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: e404,
    },

    /**
     * Auth Routes
     */
    {
        name: 'login',
        path: '/login',
        component: Login,
    },

    {
        name: 'logout',
        path: '/logout',
        component: Logout,
    },

    /**
     * Admin Routes
     */
    {
        path: '/admin',
        redirect: '/admin/projects',
    },

    {
        name: 'admin.projects.index',
        path: '/admin/projects',
        component: AdminProjectIndex,
    },

    {
        name: 'admin.projects.edit',
        path: '/admin/projects/:slug/edit',
        component: AdminProjectEdit,
    },

    {
        name: 'admin.projects.create',
        path: '/admin/projects/create',
        component: AdminProjectCreate,
    },

    /**
     * Public Routes
     */
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: { headerless: true },
    },
    {
        name: 'projects.index',
        path: '/projects',
        component: ProjectIndex,
    },
    {
        name: 'projects.show',
        path: '/projects/:project',
        component: Project,
    },
    {
        name: 'contact',
        path: '/contact',
        component: Contact,
    },
];
