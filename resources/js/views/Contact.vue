<style lang="scss" scoped>
    section {
        padding: 4rem 0;
    }

    .hero {
        position: relative;
        background-image: url('https://source.unsplash.com/random/1920x480');
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
    }

    h1, p {
        position: relative;
        color: white;
        z-index: 1;
        line-height: 1.5;
    }

    h1 {
        font-weight: 300;
        font-size: 2rem;
    }
</style>

<template>
    <div class="contact view">
        <section class="hero">
            <div class="container">
                <h1>Contact</h1>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </section>

        <section class="form">
            <div class="container">
                //
            </div>
        </section>
    </div>
</template>

<script setup>
    import axios from '@/composables/useAxios';

    //
</script>
