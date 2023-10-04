<style lang="scss" scoped>
    section {
        padding: 4rem 0;
    }

    h1 {
        color: white;
        font-weight: 300;
        letter-spacing: 1px;
        font-size: 4rem;
        margin-bottom: 2rem;
    }

    .hero {
        padding: 8rem 0;
        position: relative;
        background-position: center;
        background-size: cover;

        &::before {
            content: ' ';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(90deg, rgb(0 0 0 / 50%) 50%, transparent);
        }

        .container {
            position: relative;
            z-index: 1;
        }

        h2 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 2rem;
        }

        p {
            color: white;
        }
    }

    nav {
        padding: 1rem 0;
        position: sticky;
        top: 0;
        border-bottom: 1px solid darken(white, 10%);

        .container {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        a {
            display: block;
            padding: 1rem 2rem;
            border-radius: 10rem;
            border: 1px solid black;
            color: black;
            text-decoration: none;
            transition: color 0.25s ease, background 0.25s ease;

            &:hover, &.active {
                color: white;
                background: black;
            }
        }
    }

    .introduction:deep(p) {
        margin-left: auto;
        margin-right: auto;
    }

    .slide {
        display: flex;
    }

    .slide-image {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        background: lighten(black, 8%);

        img {
            display: block;
            max-width: 100%;
            max-height: 100%;
        }
    }

    .slide-copy {
        max-width: 50%;
        padding: 2rem;

        &:deep(h2) {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
    }
</style>

<template>
    <div class="project view" ref="root">
        <Spinner v-if="loading" />

        <div v-else>
            <section class="hero" :style="{ backgroundImage: `url(${project.hero})` }">
                <div class="container">
                    <h1>{{ project.name }}</h1>

                    <h2>
                        <span class="fa-light" :class="types.find(type => type.name === project.type)?.icon"></span>

                        {{ project.type }}
                    </h2>

                    <p>{{ project.summary }}</p>
                </div>
            </section>

            <nav>
                <div class="container">
                    <Scroll to="introduction" :class="{ active: closestSection === introduction }">Introduction</Scroll>

                    <Scroll to="gallery" :class="{ active: closestSection === gallery }">Gallery</Scroll>
                </div>
            </nav>

            <section id="introduction" class="introduction" ref="introduction">
                <div class="container" v-html="project.introduction"></div>
            </section>

            <section id="gallery" class="gallery" ref="gallery">
                <div class="container">
                    <Carousel>
                        <div class="slide" v-for="image in project.images">
                            <div class="slide-image">
                                <img :src="image.src" :alt="image.alt">
                            </div>

                            <div class="slide-copy" v-html="image.summary"></div>
                        </div>
                    </Carousel>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
    import Carousel from '@/components/Carousel.vue';
    import Scroll from '@/components/Scroll.vue';
    import Spinner from '@/components/Spinner.vue';
    import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue';
    import { useRoute } from 'vue-router';
    import { loading, projects, types } from '@/stores/projects';

    const route = useRoute();
    const project = computed(() => projects.value.find(project => project.slug === route.params.project));

    const root = ref(null);
    const introduction = ref(null);
    const gallery = ref(null);
    const sections = [introduction, gallery];
    const closestSection = ref(null);
    const getClosestSection = () => {
        if (!root.value) return;

        const viewportCenter = { x: window.innerWidth / 2, y: window.innerHeight / 2 };

        const closest = {
            section: null,
            distance: null
        };

        for (const section of sections) {
            if (!section.value) continue;
            const { top, left, width, height } = section.value.getBoundingClientRect();
            const xDistanceFromCenter = left - viewportCenter.x;
            const yDistanceFromCenter = top - viewportCenter.y;
            const distanceFromCenter = Math.sqrt((xDistanceFromCenter * xDistanceFromCenter) + (yDistanceFromCenter * yDistanceFromCenter));
            // console.log(section.value, distanceFromCenter);
            if (closest.distance === null || distanceFromCenter < closest.distance) {
                closest.section = section;
                closest.distance = distanceFromCenter;
            }
        }

        return closest.section;
    };

    let scrollTimer = 0;
    const onScroll = () => {
        if (scrollTimer) clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => closestSection.value = getClosestSection().value, 0);
    };

    onMounted(() => window.addEventListener('scroll', onScroll));
    onUnmounted(() => window.removeEventListener('scroll', onScroll));
</script>
