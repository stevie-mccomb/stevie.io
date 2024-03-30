import AdminProjectIndex from '@/views/admin/projects/Index.vue';
import Contact from '@/views/Contact.vue';
import Home from '@/views/Home.vue';
import NotFound from '@/views/errors/NotFound.vue';
import Project from '@/views/Project.vue';
import ProjectIndex from '@/views/ProjectIndex.vue';

export default [
    /**
     * Error Routes
     */
    { // 404 - Not Found
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },

    /**
     * Admin Routes
     */
    {
        path: '/admin',
        redirect: '/admin/projects'
    },

    {
        name: 'admin.projects.index',
        path: '/admin/projects',
        component: AdminProjectIndex,
    },

    {
        name: 'admin.users.index',
        path: '/admin/users',
        component: null,
    },

    /**
     * Public Routes
     */
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: { headerless: true }
    },
    {
        name: 'projects.index',
        path: '/projects',
        component: ProjectIndex
    },
    {
        name: 'projects.show',
        path: '/projects/:project',
        component: Project
    },
    {
        name: 'contact',
        path: '/contact',
        component: Contact
    },
];
