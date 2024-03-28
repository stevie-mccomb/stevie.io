import axios from '@/composables/useAxios';
import { reactive, ref } from 'vue';

export default (url, params = {}) => {
    const isFetching = ref(false);
    const fetch = () => {
        return new Promise((resolve, reject) => {
            isFetching.value = true;
            axios.get(url).then(response => resolve(response.data)).catch(reject).then(() => isFetching.value = false);
        });
    };

    const fetcher = reactive({
        isFetching,
        fetch,
    });

    return fetcher;
};
