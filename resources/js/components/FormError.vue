<template>
    <div class="form-error" v-if="errors?.length">
        <p v-for="error in errors">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        modelValue: {
            type: [Array, String],
            default: [],
        },
    });

    const errors = computed(() => (typeof props.modelValue === 'string') ? [props.modelValue] : props.modelValue);
</script>
