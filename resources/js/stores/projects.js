import axios from 'axios';
import { ref } from 'vue';

export const loading = ref(true);
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
    }
];

axios.get('/async/projects')
    .then(response => projects.value = response.data)
    .catch(error => console.error(error))
    .then(() => loading.value = false);

export default projects;
