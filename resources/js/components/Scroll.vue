<template>
    <a :href="`#${to}`" @click.prevent="scroll">
        <slot></slot>
    </a>
</template>

<script setup>
    import { onMounted, ref } from 'vue';

    const props = defineProps({
        to: {
            type: String,
            required: true
        }
    });

    const target = ref(null);

    const scroll = () => {
        if (!target.value) return;
        target.value.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    };

    onMounted(() => target.value = document.querySelector(`#${props.to}`));
</script>
