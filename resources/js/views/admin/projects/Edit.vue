<template>
    <AdminLayout>
        <div class="project-edit view">
            <h1>Edit Project</h1>

            <Form
                v-if="project?.id"
                :project="project"
                :is-submitting="isSubmitting"
                @submit="submit"
            />

            <span v-else class="fal fa-trillium fa-spin"></span>
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '@/views/admin/AdminLayout.vue';
    import Form from '@/views/admin/projects/Form.vue';
    import useErrors from '@/composables/useErrors';
    import { onProjectsLoaded, getProject, updateProject } from '@/stores/projects';
    import { onMounted, ref } from 'vue';

    const { abort } = useErrors();

    const project = ref({});
    const isSubmitting = ref(false);

    const submit = async (e, data) => {
        if (isSubmitting.value) return;
        isSubmitting.value = true;

        // const data = new FormData(e.target);
        const updatedProject = await updateProject(project.value, data);

        project.value = updatedProject;

        isSubmitting.value = false;

        router.replace({
            name: 'admin.projects.edit',
            params: {
                slug: project.value.slug,
            },
        });
    };

    onMounted(() => {
        getProject(router.currentRoute.value.params.slug, 'slug')
            .then(value => project.value = value)
            .catch(() => abort(404));
    });
</script>

<style lang="scss" scoped>
    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
</style>
