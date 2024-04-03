<template>
    <div class="editor-component" :id="id" ref="root"></div>
</template>

<script setup>
    import { randomString } from '@/helpers/strings';
    import { Editor } from '@tiptap/core';
    import StarterKit from '@tiptap/starter-kit';
    import { onMounted, ref } from 'vue';

    const emit = defineEmits([ 'update:modelValue' ]);

    const props = defineProps({
        id: {
            type: String,
            default: () => randomString(),
        },

        modelValue: {
            type: String,
            default: '',
        },
    });

    const root = ref(null);
    const editor = ref(null);

    const onUpdate = e => emit('update:modelValue', e.editor.getHTML());

    onMounted(() => {
        const options = {
            element: root.value,
            extensions: [
                StarterKit,
            ],
            content: props.modelValue,
            onUpdate,
        };

        editor.value = new Editor(options);
    });

    defineExpose({ editor });
</script>
