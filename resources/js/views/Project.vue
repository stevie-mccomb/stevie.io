<template>
    <div class="project view" ref="root">
        <Spinner v-if="isLoadingProjects" />

        <div v-else>
            <section class="hero" :style="{ backgroundImage: `url(${project.hero_url})` }">
                <div class="container">
                    <h1>{{ project.name }}</h1>

                    <h2>
                        <span class="fa-light" :class="project.type.icon"></span>

                        {{ project.type.name }}
                    </h2>

                    <p>
                        {{ project.summary }}
                    </p>

                    <a v-if="project?.url?.length" :href="project.url" target="_blank" class="button" style="margin-top: 2rem;">
                        View Project <span class="fal fa-angle-right"></span>
                    </a>
                </div>
            </section>

            <nav>
                <div class="container">
                    <Scroll to="introduction" :class="{ active: closestSection === introduction }">
                        Introduction
                    </Scroll>

                    <Scroll to="gallery" :class="{ active: closestSection === gallery }" v-if="project?.images?.length">
                        Gallery
                    </Scroll>

                    <Scroll to="technologies" :class="{ active: closestSection === technologies }" v-if="project?.technologies?.length">
                        Technologies
                    </Scroll>
                </div>
            </nav>

            <section id="introduction" class="introduction" ref="introduction">
                <div class="container" v-html="project.introduction"></div>
            </section>

            <section id="gallery" class="gallery" ref="gallery" v-if="project?.images?.length">
                <div class="container">
                    <Carousel>
                        <div class="slide" v-for="image in project.images">
                            <div class="slide-image">
                                <img :src="image.url" :alt="image.title">
                            </div>

                            <div class="slide-copy">
                                <h2>
                                    {{ image.title }}
                                </h2>

                                <p v-html="image.caption"></p>
                            </div>
                        </div>
                    </Carousel>
                </div>
            </section>

            <section id="technologies" class="technologies" ref="technologies" v-if="project?.technologies?.length">
                <div class="container">
                    <h2>Technologies</h2>

                    <div class="technology-grid">
                        <a class="technology-tile" v-for="tech in project.technologies" :href="tech.url" target="_blank">
                            <div class="image-container">
                                <img :src="tech.image" :alt="tech.name">
                            </div>

                            <section>
                                <h3>{{ tech.name }}</h3>

                                <h4>{{ tech.purpose }}</h4>

                                <span class="button">
                                    Visit Site <span class="fal fa-angle-right"></span>
                                </span>
                            </section>
                        </a>
                    </div>
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
    import { isLoadingProjects, projects, types } from '@/stores/projects';

    const route = useRoute();
    const project = computed(() => projects.value.find(project => project.slug === route.params.project));

    const root = ref(null);
    const introduction = ref(null);
    const gallery = ref(null);
    const technologies = ref(null);
    const sections = [introduction, gallery, technologies];
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

<style lang="scss" scoped>
    @import '~/master/variables';
    @import '~/master/mixins';

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
            background-image: linear-gradient(90deg, rgb(0 0 0 / 75%) 50%, transparent);
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
        top: 4rem;
        border-bottom: 1px solid darken(white, 10%);
        background: white;
        z-index: 1;

        .container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            @include breakpoint-mobile {
                flex-wrap: wrap;
                gap: 1rem;
            }
        }

        a {
            display: block;
            padding: 1rem 2rem;
            border-radius: 10rem;
            border: 1px solid black;
            color: black;
            text-decoration: none;
            transition: color 0.25s ease, background 0.25s ease;
            @include breakpoint-tablet {
                padding: 0.5rem 1rem;
            }

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
        @include breakpoint-tablet {
            flex-direction: column;
        }
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
        @include breakpoint-tablet {
            max-width: 72ch;
            margin: 0 auto;
        }

        &:deep(h2) {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
    }

    .technologies h2 {
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    .technology-grid {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .technology-tile {
        color: black;
        background: white;
        box-shadow: $shadow;
        border-radius: 1rem;
        text-decoration: none;
        transform: translateY(0);
        transition: box-shadow 0.25s ease, transform 0.25s ease;

        &:hover {
            box-shadow: $shadow-darker;
            transform: translateY(-0.25rem);
        }

        .image-container {
            padding: 2rem;
            border-bottom: 1px solid darken(white, 15%);
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            overflow: hidden;
            background: darken(white, 5%);

            img {
                max-width: 8rem;
                height: 4rem;
                display: block;
                margin: 0 auto;
            }
        }

        section {
            padding: 2rem;

            h3 {
                font-size: 1.5rem;
            }

            h4 {
                font-weight: 400;
                margin-bottom: 2rem;
            }
        }
    }
</style>
