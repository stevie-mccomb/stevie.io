<template>
    <div class="home view">
        <HomeHero />

        <section>
            <ProjectGallery intro="These are the projects I'm proudest of. If you're looking for something specific, use the filters to find projects based on their technology or purpose." />
        </section>
    </div>
</template>

<script setup>
    import HomeHero from '@/components/HomeHero.vue';
    import ProjectGallery from '@/components/ProjectGallery.vue';
</script>

<style lang="scss" scope>
    section {
        padding: 4rem 0;
    }
</style>
