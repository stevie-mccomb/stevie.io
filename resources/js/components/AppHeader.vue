<template>
    <div class="app-header" :class="{ headerless }" ref="root">
        <div class="container">
            <router-link to="/" class="site-title-link">
                <h2>Stevie McComb</h2>
            </router-link>

            <button type="button" @click="toggleSidebar">
                <span class="fas fa-bars"></span>
            </button>

            <nav class="app-navigation" :class="{ 'is-open': isSidebarOpen }">
                <button type="button" @click.prevent="toggleSidebar">
                    <span class="fal fa-times"></span>
                </button>

                <router-link to="/">Home</router-link>

                <router-link to="/projects">Projects</router-link>

                <router-link to="/contact">Contact</router-link>
            </nav>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';

    const props = defineProps({
        headerless: {
            type: Boolean,
            default: false,
        },
    });

    const isSidebarOpen = ref(false);
    const root = ref(null);

    const openSidebar = () => isSidebarOpen.value = true;
    const closeSidebar = () => isSidebarOpen.value = false;
    const toggleSidebar = () => isSidebarOpen.value ? closeSidebar() : openSidebar();

    onMounted(() => {
        const anchors = root.value.querySelectorAll('a');
        for (const anchor of anchors) {
            anchor.addEventListener('click', closeSidebar);
        }
    });

    onUnmounted(() => {
        for (const anchor of root.value.querySelectorAll('a')) {
            anchor.removeEventListener('click', closeSidebar);
        }
    });
</script>

<style lang="scss" scoped>
    @import '~/master/variables';

    .app-header {
        position: sticky;
        top: 0;
        left: 0;
        z-index: 10;
        width: 100%;
        background: white;
        box-shadow: $shadow;
        transition: transform 0.25s ease;

        &.headerless {
            transform: translateY(-100%);
        }
    }

    .site-title-link {
        border-bottom: 0;
        text-decoration: none;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        padding-top: 1rem;
        padding-bottom: 1rem;

        > button {
            display: none;
            background: transparent;
            margin: 0;
            padding: 0;
            @media (max-width: 640px) {
                display: block;
            }
        }
    }

    a {
        text-decoration: none;
    }

    h2 {
        letter-spacing: 0.1rem;
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    nav {
        display: flex;
        gap: 1rem;

        button {
            display: none;
        }

        @media (max-width: 640px) {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            background: white;
            box-shadow: 0 -20px 25px -5px rgb(0 0 0 / 15%), 0 -10px 25px -5px rgb(0 0 0 / 25%);
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.5s ease;

            &.is-open {
                transform: translateX(0);
            }

            a, button {
                padding: 1rem 2rem;
            }

            button {
                display: block;
                color: white;
                background: black;
            }
        }
    }
</style>
