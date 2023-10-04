<style lang="scss" scoped>
    section {
        padding: 4rem 0;
    }

    h1 {
        color: black;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 4rem;
    }
</style>

<template>
    <div class="project-index view">
        <section>
            <div class="container">
                <h1>Projects</h1>

                <ProjectGallery />
            </div>
        </section>
    </div>
</template>

<script setup>
    import ProjectGallery from '@/components/ProjectGallery.vue';
</script>
