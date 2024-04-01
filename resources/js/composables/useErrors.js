import { computed, ref } from 'vue';
import e404 from '@/views/errors/e404.vue';
import e418 from '@/views/errors/e418.vue';
import e500 from '@/views/errors/e500.vue';

const errorComponents = {
    e404,
    e418,
    e500,
};

export const status = ref(200);
export const statusMessage = ref('OK');

export const errorComponent = computed(() => {
    const key = `e${status.value}`;
    if (errorComponents.hasOwnProperty(key)) {
        return errorComponents[key];
    }

    return e500;
});

export const abort = (code, message = 'An unknown error occurred.') => {
    status.value = code;
    statusMessage.value = message;
};

export default () => ({ abort, errorComponent, status, statusMessage });
