import axios from '@/composables/useAxios';

export default async callback => {
    await axios.get('/sanctum/csrf-cookie');
    if (callback) callback();
};
