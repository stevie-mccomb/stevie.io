<template>
    <AdminLayout>
        <div class="project-index view">
            <h1>Projects</h1>

            <div class="projects-list">
                <div class="project" v-for="project in projects">
                    <img class="cover" :src="project.cover_url" :alt="project.name">

                    <section>
                        <h2>{{ project.name }}</h2>

                        <p>{{ project.summary }}</p>

                        <div class="buttons">
                            <router-link class="button" :to="{ name: 'admin.projects.edit', params: { slug: project.slug } }">
                                <span class="fal fa-edit"></span> Edit Project
                            </router-link>

                            <a class="outline button" href="#" @click.prevent="onClickDeleteProject(project)">
                                <span class="fal fa-trash"></span> Delete Project
                            </a>
                        </div>
                    </section>
                </div>

                <router-link class="create-project" :to="{ name: 'admin.projects.create' }">
                    Create Project
                </router-link>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '@/views/admin/AdminLayout.vue';
    import { isLoadingProjects, projects, deleteProject } from '@/stores/projects';

    const onClickDeleteProject = project => {
        if (!confirm('Are you sure? This is permanent!')) return;
        deleteProject(project);
    };
</script>

<style lang="scss" scoped>
    @import '~/master/variables';

    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    .projects-list {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .project {
        display: flex;
        background: white;
        border-radius: 0.25rem;
        box-shadow: $shadow;
        position: relative;

        .image-padding {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            aspect-ratio: 1/1;
        }

        .image-mask {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding-right: 100%;
        }

        img {
            height: 100%;
            max-height: 16rem;
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        section {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 2rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            margin-top: auto;
        }
    }

    .create-project {
        padding: 2rem;
        border-radius: 0.25rem;
        background: white;
        box-shadow: $shadow;
    }
</style>
