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

            <textarea id="introduction" name="introduction" rows="8" v-model="project.introduction"></textarea>
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
    import Slug from '@/components/Slug.vue';
    import { types } from '@/stores/projects';
    import { technologies } from '@/stores/technologies';
    import { ref } from 'vue';

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
    const isSubmitting = ref(false);

    const submit = e => emit('submit', e);
</script>

<style lang="scss" scoped>
    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
</style>
