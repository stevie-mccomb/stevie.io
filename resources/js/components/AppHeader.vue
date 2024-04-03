<template>
    <div class="app-header" :class="{ headerless }">
        <div class="container">
            <router-link to="/">
                <h2>Stevie McComb</h2>
            </router-link>

            <nav class="app-navigation">
                <router-link to="/">Home</router-link>

                <router-link to="/projects">Projects</router-link>

                <router-link to="/contact">Contact</router-link>
            </nav>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        headerless: {
            type: Boolean,
            default: false,
        },
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

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
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
    }
</style>
