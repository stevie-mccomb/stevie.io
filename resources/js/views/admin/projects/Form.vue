<template>
    <form ref="form" @submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">
                Name <span class="form-required">*</span>
            </label>

            <input id="name" name="name" type="text" v-model="project.name">
        </div>

        <div class="form-group">
            <label for="slug">
                Slug <span class="form-required">*</span>
            </label>

            <Slug v-model="project.slug" />
        </div>

        <div class="form-group">
            <label for="type">
                Type <span class="form-required">*</span>
            </label>

            <select id="type" name="type" v-model="project.type.name">
                <option value="">- Please Choose One -</option>

                <option v-for="type in types" :value="type.name">
                    {{ type.name }}
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>

            <input id="cover" name="cover" type="file" accept="image/*">
        </div>

        <div class="form-group">
            <label for="hero">Hero</label>

            <input id="hero" name="hero" type="file" accept="image/*">
        </div>

        <div class="form-group">
            <label for="url">URL</label>

            <input id="url" name="url" type="url" v-model="project.url">
        </div>

        <div class="form-group">
            <label for="summary">Summary <span class="form-required">*</span></label>

            <textarea id="summary" name="summary" rows="3" v-model="project.summary"></textarea>
        </div>

        <div class="form-group">
            <label for="introduction">Introduction <span class="form-required">*</span></label>

            <Editor ref="introduction" v-model="project.introduction" />

            <!-- <textarea name="introduction" v-model="introductionString" style="display: none;"></textarea> -->
        </div>

        <div class="form-group" v-if="project?.id">
            <label for="images">Images</label>

            <ProjectImageManager ref="projectImageManager" v-model="project.images" />
        </div>

        <div class="form-group">
            <label for="technologies">Technologies</label>

            <select id="technologies" name="technologies[]" multiple :size="technologies.length - 1" v-model="project.technology_ids">
                <option v-for="technology in technologies" :value="technology.id">
                    {{ technology.name }}
                </option>
            </select>
        </div>

        <button class="button" type="submit">
            <span class="fal" :class="isSubmitting ? 'fa-trillium fa-spin' : 'fa-save'"></span> {{ isSubmitting ? 'Saving...' : 'Save Project' }}
        </button>
    </form>
</template>

<script setup>
    import Carousel from '@/components/Carousel.vue';
    import Editor from '@/components/Editor.vue';
    import ProjectImageManager from '@/components/ProjectImageManager.vue';
    import Slug from '@/components/Slug.vue';
    import { types } from '@/stores/projects';
    import { technologies } from '@/stores/technologies';
    import { nextTick, ref } from 'vue';

    const emit = defineEmits([ 'submit' ]);

    const props = defineProps({
        isSubmitting: {
            type: Boolean,
            default: false,
        },

        project: {
            type: Object,
            required: true,
        },
    });

    const form = ref(null);
    const introduction = ref(null);
    const projectImageManager = ref(null);
    const introductionString = ref(props.project.introduction);
    const isSubmitting = ref(false);

    const submit = async e => {
        const data = new FormData(form.value);

        data.append('introduction', introduction.value.editor.getHTML());
        // introductionString.value = introduction.value.editor.getHTML();

        for (let i = 0; i < projectImageManager.value.images.length; ++i) {
            const image = projectImageManager.value.images[i];
            data.append(`images[${image.id}][id]`, image.id);
            data.append(`images[${image.id}][title]`, image.title);
            data.append(`images[${image.id}][caption]`, image.caption);
            if (image.file) data.append(`images[${image.id}][file]`, image.file);
            data.append(`images[${image.id}][sort_order]`, i + 1);
        }

        await nextTick();

        emit('submit', e, data);
    };
</script>

<style lang="scss" scoped>
    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    :deep(.tiptap) {
        background: white;
        padding: 1rem;
        border-radius: 0.25rem;
        border: 1px solid darken(white, 15%);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>
