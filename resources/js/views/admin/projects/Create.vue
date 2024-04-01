<template>
    <AdminLayout>
        <div class="project-create view">
            <h1>Create Project</h1>

            <Form
                :project="project"
                :is-submitting="isSubmitting"
                @submit="submit"
            />
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '@/views/admin/AdminLayout.vue';
    import Form from '@/views/admin/projects/Form.vue';
    import { storeProject } from '@/stores/projects';
    import { reactive, ref } from 'vue';

    const project = reactive({
        type: {},
        technology_ids: [],
    });
    const isSubmitting = ref(false);

    const submit = async e => {
        if (isSubmitting.value) return;
        isSubmitting.value = true;

        const data = new FormData(e.target);

        const project = await storeProject(data);

        router.push({
            name: 'admin.projects.edit',
            params: {
                slug: project.slug,
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
