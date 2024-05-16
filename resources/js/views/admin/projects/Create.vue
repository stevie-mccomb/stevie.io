<template>
    <AdminLayout>
        <div class="project-create view">
            <h1>Create Project</h1>

            <ProjectForm
                :project="project"
                :is-submitting="isSubmitting"
                @submit="submit"
            />
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '@/views/admin/AdminLayout.vue';
    import ProjectForm from '@/views/admin/projects/Form.vue';
    import { storeProject } from '@/stores/projects';
    import { ref } from 'vue';

    const project = ref({
        type: {},
        introduction: '',
        technology_ids: [],
    });
    const isSubmitting = ref(false);

    const submit = async (e, data) => {
        if (isSubmitting.value) return;
        isSubmitting.value = true;

        // const data = new FormData(e.target);
        // for (const entry of data.entries()) {
        //     console.log(entry);
        // }

        const updatedProject = await storeProject(data).finally(() => isSubmitting.value = false);

        router.push({
            name: 'admin.projects.edit',
            params: {
                slug: updatedProject.slug,
            },
        });

        isSubmitting.value = false;
    };
</script>

<style lang="scss" scoped>
    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
</style>
