<template>
    <div class="project-gallery-component">
        <div class="container">
            <div class="intro" v-if="$slots.intro">
                <slot name="intro"></slot>
            </div>

            <div class="sidebar-and-grid-container">
                <aside class="sidebar">
                    <section>
                        <header>
                            Project Types
                        </header>

                        <Checkbox v-for="type in types" :value="type.name" v-model="selectedTypes">
                            {{ type.name }}
                        </Checkbox>
                    </section>

                    <section>
                        <header>
                            Technologies
                        </header>

                        <Checkbox v-for="technology in technologies" :value="technology.name" v-model="selectedTechnologies">
                            {{ technology.name }}
                        </Checkbox>
                    </section>
                </aside>

                <div class="spinner" v-if="isLoadingProjects">
                    <span class="fa-light fa-trillium fa-spin"></span>
                </div>

                <div class="project-grid" v-else-if="projects.length">
                    <TransitionGroup>
                        <div class="cell" v-for="project in filteredProjects" :key="project.id">
                            <div class="cell-padding">
                                <router-link :to="`/projects/${project.slug}`" class="tile">
                                    <div class="flip-container">
                                        <div class="front" :style="{ backgroundImage: `url(${project.cover_url})` }">
                                            <span class="overlay">
                                                <span class="project-name">
                                                    {{ project.name }}
                                                </span>

                                                <span class="project-type">
                                                    <span class="fa-light" :class="types.find(type => type.name === project.type.name).icon"></span>

                                                    <span>
                                                        {{ project.type.name }}
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div class="back">
                                            <h3>
                                                {{ project.name }}
                                            </h3>

                                            <h4>
                                                <span class="fa-light" :class="types.find(type => type.name === project.type.name).icon"></span>

                                                {{ project.type.name }}
                                            </h4>

                                            <p>
                                                {{ project.summary }}
                                            </p>

                                            <span class="anchor">
                                                View Project <span class="fa-light fa-long-arrow-right" style="margin-left: 1rem;"></span>
                                            </span>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </TransitionGroup>
                </div>

                <p v-else>
                    An error occurred when loading the projects, please refresh and try again.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Checkbox from '@/components/Checkbox.vue';
    import useFetcher from '@/composables/useFetcher';
    import { syncQueryParam, useQueryString } from '@/composables/useQueryString';
    import { computed, onMounted, ref } from 'vue';
    import { isLoadingProjects, projects, types } from '@/stores/projects';

    const props = defineProps({
        intro: {
            type: String,
            default: ''
        }
    });
    const selectedTypes = ref(useQueryString.types ?? []);
    syncQueryParam('types', selectedTypes);

    const technologyFetcher = useFetcher('/async/technologies');
    const technologies = ref([]);
    const selectedTechnologies = ref([]);
    syncQueryParam('technologies', selectedTechnologies);

    const filteredProjects = computed(() => {
        let filtered = projects.value.slice();

        if (selectedTypes.value?.length) {
            filtered = filtered.filter(project => selectedTypes.value.includes(project.type?.name));
        }

        if (selectedTechnologies.value?.length) {
            filtered = filtered.filter(project => {
                const projectTechnologyNames = project.technologies.map(tech => tech.name);
                const intersection = selectedTechnologies.value.filter(name => projectTechnologyNames.includes(name));
                return intersection.length > 0;
            });
        }

        return filtered;
    });

    onMounted(async () => technologies.value = await technologyFetcher.fetch());
</script>

<style lang="scss" scoped>
    @import '../../scss/master/variables';
    @import '../../scss/master/mixins';

    .intro {
        color: #666;

        :deep(p) {
            display: block;
            margin: 0 auto 2rem auto;
        }
    }

    .sidebar-and-grid-container {
        display: flex;
        gap: 2rem;
        @include breakpoint-mobile {
            flex-direction: column-reverse;
            gap: 1rem;
        }
    }

    .sidebar section {
        margin-bottom: 2rem;
    }

    .sidebar header {
        color: black;
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .spinner {
        font-size: 4rem;
    }

    .project-grid {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        @include breakpoint-legacy {
            grid-template-columns: 1fr 1fr 1fr;
        }
        @include breakpoint-tablet {
            grid-template-columns: 1fr 1fr;
        }
        @include breakpoint-mobile {
            grid-template-columns: 1fr;
        }
    }

    .cell {
        position: relative;
        max-height: 32rem;
        @include breakpoint-mobile {
            min-height: 24rem;
        }
    }

    .cell-padding {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .tile {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        border-radius: 0.25rem;
        border-bottom: 0;
        text-decoration: none;
        transform: translateY(0);
        transition: transform 0.5s ease;

        &:hover {
            transform: translateY(-0.25rem);

            .flip-container {
                transform: rotateY(180deg);
            }

            .front, .back {
                box-shadow: $shadow-darker;
            }
        }
    }

    .flip-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.5s ease;
        perspective: 100px;
    }

    .front, .back {
        padding: 2rem;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        box-sizing: border-box;
        box-shadow: $shadow;
        transition: box-shadow 0.5s ease;

        h3, h4, p, .anchor {
            color: white;
        }
    }

    .front {
        border-radius: 0.25rem;
        background-position: center center;
        background-size: cover;
    }

    .back {
        display: flex;
        flex-direction: column;
        z-index: 1;
        transform: rotateY(180deg);
        border-radius: 0.25rem;
        background: black;
    }

    .overlay {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgb(0 0 0 / 75%);
        padding: 1rem;
        box-sizing: border-box;
        color: white;
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .project-name {
        line-height: 1.5;
        font-weight: 800;
    }

    .project-type {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    h3 {
        font-weight: 800;
        line-height: 1.25;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    h4 {
        font-weight: 300;
        margin-bottom: 2rem;
        font-style: italic;
    }

    p {
        margin-bottom: 0;
    }

    .anchor {
        margin-top: auto;
    }

    .v-move, .v-enter-active, .v-leave-active {
        transform-origin: center center;
        transition: all 0.25s ease;
    }

    .v-enter-from, .v-leave-to {
        opacity: 0;
        transform: scale(0);
    }
</style>
