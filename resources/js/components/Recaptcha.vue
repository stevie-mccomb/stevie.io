<template>
    <div class="recaptcha-component" ref="root">
        <slot></slot>
    </div>
</template>

<script setup>
    //

    // import { onMounted, onUnmounted, ref } from 'vue';

    // const props = defineProps({
    //     action: {
    //         type: String,
    //         required: true,
    //     },

    //     gRecaptchaKey: {
    //         type: String,
    //         required: true,
    //     },
    // });

    // const root = ref(null);
    // let form;
    // const queue = ref(null);

    // const onScriptLoad = () => {
    //     if (queue.value) {
    //         grecaptcha.ready(queue.value);
    //         queue.value = null;
    //     }
    // };

    // const onFormSubmit = e => {
    //     e.preventDefault();

    //     queue.value = () => {
    //         grecaptcha
    //             .execute(props.gRecaptchaKey, { action: props.action })
    //             .then(token => {
    //                 const input = document.createElement('input');
    //                 input.setAttribute('type', 'hidden');
    //                 input.setAttribute('name', 'g-recaptcha-response');
    //                 input.value = token;
    //                 form.appendChild(input);

    //                 form.submit();
    //             });
    //     };

    //     if (grecaptcha) {
    //         grecaptcha.ready(queue.value);
    //         queue.value = null;
    //     }

    //     return false;
    // };

    // const script = document.createElement('scr' + 'ipt');
    // script.addEventListener('load', onScriptLoad);
    // script.setAttribute('src', `https://www.google.com/recaptcha/api.js?render=${props.gRecaptchaKey}`);
    // document.body.appendChild(script);

    // onMounted(() => {
    //     form = root.value.querySelector('form');
    //     form.addEventListener('submit', onFormSubmit);
    // });

    // onUnmounted(() => {
    //     form.removeEventListener('submit', onFormSubmit);
    // });
</script>
