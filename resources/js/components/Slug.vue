<template>
    <input class="slug-component" ref="input" :id="id" :name="name" type="text" :placeholder="placeholder" :value="modelValue" @input="manuallyUpdate" @blur="modelValue = trim(modelValue)" :readonly="readonly">
</template>

<script setup>
    import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue';

    const emit = defineEmits([ 'update:modelValue' ]);

    const props = defineProps({
        id: {
            type: String,
            default: 'slug',
        },

        name: {
            type: String,
            default: 'slug',
        },

        for: {
            type: String,
            default: '#name',
        },

        modelValue: {
            type: String,
            default: '',
        },

        placeholder: {
            type: String,
            default: '',
        },

        value: {
            type: String,
            default: '',
        },

        readonly: {
            type: Boolean,
            default: false,
        },
    });

    const input = ref(null);
    const dependent = ref(null);
    const manual = ref(props.modelValue.length > 0);
    const modelValue = ref(props.modelValue);

    const format = value => value.toLowerCase().replace(/\W/gi, '-').replace(/-{2,}/gi, '-');

    const manuallyUpdate = async (event) => {
        const start = input.value.selectionStart;
        const end = input.value.selectionEnd;

        modelValue.value = format(event.target.value);

        manual.value = modelValue.value.length > 0;

        await nextTick();

        input.value.setSelectionRange(start, end);
    };

    const trim = value => {
        value = value.trim();
        if (value.substr(0, 1) === '-') value = value.substr(1);
        if (value.substr(value.length - 1, 1) === '-') value = value.substr(0, value.length - 1);
        return value;
    };

    const update = () => {
        if (manual.value || !dependent.value?.value) return false;
        modelValue.value = trim(format(dependent.value.value));
    };

    watch(modelValue, value => emit('update:modelValue', value));
    watch(() => props.modelValue, value => modelValue.value = value);

    onMounted(() => {
        dependent.value = document.querySelector(props.for);

        if (dependent.value?.addEventListener) {
            dependent.value.addEventListener('input', update);
        } else {
            manual.value = true;
        }

        update();
    });

    onUnmounted(() => {
        if (dependent.value?.removeEventListener) {
            dependent.value.removeEventListener('input', update);
        }
    });
</script>
