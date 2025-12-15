import useCsrfToken from '@/composables/useCsrfToken';
import axios from 'axios';
import { ref } from 'vue';

const callbacks = [];

export const isLoadingProjects = ref(true);
export const projects = ref([]);
export const types = [
    {
        name: 'Web App',
        icon: 'fa-code-fork'
    },
    {
        name: 'Website',
        icon: 'fa-desktop'
    },
    {
        name: 'Mobile App',
        icon: 'fa-mobile'
    },
    {
        name: 'Video Game',
        icon: 'fa-gamepad'
    },
    {
        name: 'Game Engine',
        icon: 'fa-engine'
    },
    {
        name: 'Framework',
        icon: 'fa-screwdriver-wrench'
    }
];

export const onProjectsLoaded = callback => {
    if (isLoadingProjects.value) {
        callbacks.push(callback);
    } else {
        callback(projects.value);
    }
};

export const getProject = async (key, column = 'id') => {
    const _getProject = () => {
        for (const project of projects.value) {
            if (project[column] === key) {
                return project;
            }
        }

        return null;
    };

    return new Promise((resolve, reject) => {
        const callback = () => {
            const project = _getProject();

            if (!!project) {
                return resolve(project);
            }

            return reject();
        };

        if (isLoadingProjects.value) {
            callbacks.push(callback);
        } else {
            callback();
        }
    });
};

export const storeProject = async data => {
    await useCsrfToken();

    const response = await axios.post(`/async/projects`, data);

    const project = response.data.project;

    projects.value.push(project);

    return project;
};

export const updateProject = async ({ id }, data) => {
    await useCsrfToken();

    if (!data.has('_method')) data.append('_method', 'PATCH');

    const response = await axios.post(`/async/projects/${id}`, data);

    const project = response.data.project;

    for (let i = projects.value.length - 1; i >= 0; i--) {
        if (projects.value[i].id === id) {
            projects.value[i] = project;
            return project;
        }
    }

    projects.value.push(project);

    return project;
};

export const deleteProject = project => {
    axios.delete(`/async/projects/${project.id}`)
        .then(response => {
            projects.value = projects.value.filter(p => p.id !== project.id);
        })
        .catch(console.error);
};

axios.get('/async/projects')
    .then(response => {
        projects.value = response.data;
        console.log(projects.value);
        if (callbacks.length) {
            for (const callback of callbacks) {
                callback(projects.value);
            }
        }
    })
    .catch(error => console.error(error))
    .then(() => isLoadingProjects.value = false);

export default projects;
