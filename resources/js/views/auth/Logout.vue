<template>
    <Layout class="logout">
        <template v-slot:default style="text-align: center;">
            <span class="fal fa-trillium fa-spin"></span>

            <h1>Logging out, please wait...</h1>

            <span class="fal fa-trillium fa-spin"></span>
        </template>
    </Layout>
</template>

<script setup>
    import axios from '@/composables/useAxios';
    import useCsrfToken from '@/composables/useCsrfToken';
    import Layout from '@/views/auth/Layout.vue';
    import { onMounted, ref } from 'vue';

    if (!window?.User?.id) {
        router.replace({ name: 'home' });
    }

    onMounted(() => {
        useCsrfToken(() => {
            axios.post('/auth/logout')
                .then(response => {
                    window.User = null;
                    router.replace({ name: 'home' });
                })
                .catch(console.error);
        });
    });
</script>

<style lang="scss" scoped>
    :deep(section) {
        text-align: center;
    }

    h1 {
        display: inline;
        margin: 0 1rem;
    }
</style>
