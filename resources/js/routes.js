import Contact from '@/views/Contact.vue';
import Home from '@/views/Home.vue';
import Project from '@/views/Project.vue';
import ProjectIndex from '@/views/ProjectIndex.vue';

export default [
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
    }
];
