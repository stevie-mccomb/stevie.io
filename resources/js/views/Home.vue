<template>
    <div class="home view">
        <HomeHero />

        <section>
            <ProjectGallery>
                <template v-slot:intro>
                    <p>
                        <strong>Over more than two decades</strong> of web design, development, architecture, and dev-ops, I've worked on countless products across dozens of industries. In preparing this portfolio, <strong>I've hand-picked my favorite projects</strong> that I'm proudest of (and that I have the rights to share).
                    </p>
                    
                    <p>
                        Projects are simply listed in alphabetical order. If you would like to see examples of work related to any particular industry or use-case, <RouterLink to="/contact">contact me</RouterLink> with context and I will see what projects I have available to share.
                    </p>
                </template>
            </ProjectGallery>
        </section>
    </div>
</template>

<script setup>
    import HomeHero from '@/components/HomeHero.vue';
    import ProjectGallery from '@/components/ProjectGallery.vue';
    import { RouterLink } from 'vue-router';
</script>

<style lang="scss" scoped>
    section {
        padding: 4rem 0;
    }
</style>
