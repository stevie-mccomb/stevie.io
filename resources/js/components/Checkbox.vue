<style lang="scss" scope>
    .checkbox-component {
        cursor: pointer;
        display: flex;
        gap: 0.25rem;
        line-height: 1.5;
    }
</style>

<template>
    <div class="checkbox-component" :tabindex="tabindex" @click="toggle" @keydown.space.prevent="toggle">
        <div class="icon-container">
            <span class="fal fa-lg fa-fw" :class="{ 'fa-check-square': checked, 'fa-square': !checked }"></span>

            <input v-show="false" type="checkbox" :name="name" :value="value" :checked="checked">
        </div>

        <div class="content-container">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
    import { ref, watch } from 'vue';

    const emit = defineEmits([ 'update:modelValue' ]);

    const props = defineProps({
        checked: {
            type: Boolean,
            default: false
        },

        modelValue: {
            type: [Array, Boolean, Number],
            default: false
        },

        name: {
            type: String,
            default: ''
        },

        tabindex: {
            type: Number,
            default: 0
        },

        value: {
            type: String,
            default: 'on'
        }
    });

    const checked = ref(false);
    switch (true) {
        case (Array.isArray(props.modelValue)):
            checked.value = props.modelValue.includes(props.value);
            break;

        case (props.modelValue === true):
        case (props.modelValue === 1):
            checked.value = true;
            break;

        default:
            checked.value = props.checked;
            break;
    }

    const toggle = () => checked.value = !checked.value;

    watch(checked, value => {
        if (Array.isArray(props.modelValue)) {
            const newValue = props.modelValue.slice();
            const index = newValue.indexOf(props.value);
            if (value && index < 0) newValue.push(props.value);
            if (!value && index >= 0) newValue.splice(index, 1);
            emit('update:modelValue', newValue);
        } else {
            emit('update:modelValue', value);
        }
    });
</script>
