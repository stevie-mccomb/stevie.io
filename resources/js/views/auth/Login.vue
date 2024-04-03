<template>
    <Layout class="login" action="/login" @submit.prevent="submit">
        <template v-slot:header>
            <h1>Log In</h1>
        </template>

        <template v-slot:default>
            <div class="form-group">
                <label for="email">Email</label>

                <input id="email" name="email" type="email" v-model="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input id="password" name="password" type="password" v-model="password">
            </div>

            <div class="form-group">
                <Checkbox name="remember_me">
                    Remember me (for 2 weeks)
                </Checkbox>
            </div>
        </template>

        <template v-slot:footer>
            <button class="button" type="submit">
                <span class="fal fa-unlock"></span> Log In
            </button>
        </template>
    </Layout>
</template>

<script setup>
    import Checkbox from '@/components/Checkbox.vue';
    import axios from '@/composables/useAxios';
    import useCsrfToken from '@/composables/useCsrfToken';
    import Layout from '@/views/auth/Layout.vue';
    import { ref } from 'vue';

    if (window?.User?.id !== undefined) {
        router.replace({ name: 'home' });
    }

    const email = ref('');
    const password = ref('');

    const submit = e => {
        useCsrfToken(() => {
            const params = {
                email: email.value,
                password: password.value,
            };

            axios.post('/auth/login', params)
                .then(response => {
                    window.User = response.data.user;

                    const intended = router.currentRoute?.value?.query?.intended ?? { name: 'admin.projects.index' };
                    router.push(intended);
                })
                .catch(console.error);
        });
    };
</script>
