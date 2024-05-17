<template>
    <div class="contact view">
        <section class="hero">
            <div class="container">
                <h1>Contact</h1>

                <p>Send me a message and you'll receive a prompt response. If you're a client that needs assistance with an existing project, please reach out directly via email or phone for a more immediate response.</p>
            </div>
        </section>

        <section class="form">
            <div class="container">
                <p v-if="successMessage.length">
                    {{ successMessage }}
                </p>

                <form @submit.prevent="submit" v-else>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name <span class="form-required">*</span></label>

                            <input id="first_name" name="first_name" type="text" v-model="fields.first_name">

                            <FormError v-model="errors.first_name" />
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name <span class="form-required">*</span></label>

                            <input id="last_name" name="last_name" type="text" v-model="fields.last_name">

                            <FormError v-model="errors.last_name" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="form-required">*</span></label>

                            <input id="email" name="email" type="text" v-model="fields.email">

                            <FormError v-model="errors.email" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>

                            <input id="phone" name="phone" type="text" v-model="fields.phone">

                            <FormError v-model="errors.phone" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message <span class="form-required">*</span></label>

                        <textarea id="message" name="message" rows="8" v-model="fields.message"></textarea>

                        <FormError v-model="errors.message" />
                    </div>

                    <FormError v-model="errors['g-recaptcha-response']" style="margin-bottom: 2rem;" />

                    <button class="button" type="submit">
                        <span class="fal" :class="isSending ? 'fa-trillium fa-spin' : 'fa-paper-plane'"></span>

                        {{ isSending ? 'Sending...' : 'Send Message' }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</template>

<script setup>
    import FormError from '@/components/FormError.vue';
    import axios from '@/composables/useAxios';
    import useRecaptcha from '@/composables/useRecaptcha';
    import { reactive, ref } from 'vue';
    import { onProjectsLoaded } from '@/stores/projects';

    const successMessage = ref('');
    const isSending = ref(false);

    const errors = ref({});
    const fields = reactive({
        'first_name': '',
        'last_name': '',
        'email': '',
        'phone': '',
        'message': '',
        'g-recaptcha-response': '',
    });
    const heroImage = ref('');

    const submit = async () => {
        if (isSending.value) return;
        isSending.value = true;

        const { token } = await useRecaptcha();
        fields['g-recaptcha-response'] = token;

        axios.post('/async/contact', fields)
            .then(response => successMessage.value = response.data.message)
            .catch(e => {
                if (e?.response?.data?.errors) {
                    errors.value = e.response.data.errors;
                }
            })
            .then(() => isSending.value = false);
    };

    onProjectsLoaded(projects => {
        heroImage.value = projects.random().hero_url;
    });
</script>

<style lang="scss" scoped>
    @import '~/master/variables';
    @import '~/master/mixins';

    section {
        padding: 4rem 0;
    }

    .hero {
        position: relative;
        background-image: url('/img/contact-hero.webp');
        background-position: center;
        background-size: cover;
        @include breakpoint-tablet {
            background-position: 75%;
        }

        &::before {
            content: ' ';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(90deg, rgb(0 0 0 / 50%) 50%, transparent);
            @include breakpoint-tablet {
                background-image: none;
                background-color: rgb(0 0 0 / 75%);
            }
        }

        h1, p {
            position: relative;
            color: white;
            z-index: 1;
            line-height: 1.5;
        }

        h1 {
            font-weight: 300;
            font-size: 2rem;
        }
    }
</style>
