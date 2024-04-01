import axios from 'axios';
import { ref } from 'vue';

const callbacks = [];

export const isLoadingTechnologies = ref(true);
export const technologies = ref([]);

export const onTechnologiesLoaded = callback => {
    if (isLoadingTechnologies.value) {
        callbacks.push(callback);
    } else {
        callback(technologies.value);
    }
};

axios.get('/async/technologies')
    .then(response => {
        technologies.value = response.data;
        if (callbacks.length) {
            for (const callback of callbacks) {
                callback(technologies.value);
            }
        }
    })
    .catch(error => console.error(error))
    .then(() => isLoadingTechnologies.value = false);

export default technologies;
