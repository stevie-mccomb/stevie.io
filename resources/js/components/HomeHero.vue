<template>
    <div class="home-hero-component">
        <div class="copy-container">
            <Transition @after-enter="++animationStep">
                <h1 v-show="loaded" :class="{ loaded }">Stevie McComb</h1>
            </Transition>

            <Transition @after-enter="++animationStep">
                <h2 v-show="animationStep > 0" :class="{ loaded: animationStep > 0 }">Full-stack Web Developer</h2>
            </Transition>

            <Transition @after-enter="++animationStep">
                <h5 v-show="animationStep > 1" :class="{ loaded: animationStep > 1 }">(&amp; Wannabe Spaceship Captain)</h5>
            </Transition>

            <Transition @after-enter="++animationStep">
                <span v-show="animationStep > 2" :class="{ loaded: animationStep > 2 }" class="fal fa-rocket-launch"></span>
            </Transition>

            <Transition @after-enter="++animationStep">
                <h3 v-show="animationStep > 3" :class="{ loaded: animationStep > 3 }">LAMP Stack</h3>
            </Transition>

            <Transition @after-enter="++animationStep">
                <h4 v-show="animationStep > 4" :class="{ loaded: animationStep > 4 }">Linux, Apache, MySQL, PHP</h4>
            </Transition>
        </div>

        <canvas ref="canvas" :width="canvasWidth" :height="canvasHeight"></canvas>

        <div class="scroll-curve">
            <svg width="100%" viewBox="0 0 1920 128" xmlns="http://www.w3.org/2000/svg">
                <path d="M 0 0 Q 960 128 1920 0 L 1920 128 L 0 128 Z"></path>
            </svg>

            <span class="fa-light fa-computer-mouse-scrollwheel"></span>
        </div>
    </div>
</template>

<script setup>
    import '@/prototypes/Array';
    import '@/prototypes/Number';
    import { randomFloat, randomInt } from '@/helpers/math';
    import { computed, onMounted, onUnmounted, ref } from 'vue';

    const loaded = ref(false);
    const canvas = ref(null);
    const canvasWidth = ref(1920);
    const canvasHeight = ref(1080);
    const animationStep = ref(0);

    const context = computed(() => canvas.value?.getContext ? canvas.value.getContext('2d') : null);
    const canvasCenter = computed(() => ({ x: canvasWidth.value / 2, y: canvasHeight.value / 2 }));

    const stars = [];
    let delta = 0.16;
    let lastUpdated = 0;
    let animationFrame;

    const generateStar = () => {
        const opacity = randomFloat(0.25, 0.75, 2);
        const radius = randomFloat(0.5, 2, 2);
        const x = randomInt(0, 1920);
        const y = randomInt(0, 1920);
        const angle = randomInt(0, 360);

        const xDistance = x - canvasCenter.value.x;
        const yDistance = y - canvasCenter.value.y;
        const distanceFromCenter = Math.sqrt((xDistance * xDistance) + (yDistance * yDistance));

        const speed = ((16 / distanceFromCenter) * 1000).clamp(1, 32);

        const colors = ['white', '#ffa', '#faf'];
        const color = colors.random();


        return { opacity, radius, x, y, angle, speed, color };
    };

    const generateStars = (countStars = 3200) => {
        while (stars.length) stars.pop();
        for (let i = 0; i < countStars; ++i) {
            stars.push(generateStar());
        }
    };

    const loop = timestamp => {
        delta = (timestamp - lastUpdated) / 1000;

        update();

        lastUpdated = timestamp;

        animationFrame = requestAnimationFrame(loop);
    };

    const update = () => {
        if (!context.value?.clearRect) return;

        const endAngle = 2 * Math.PI;

        context.value.clearRect(0, 0, canvas.value.width, canvas.value.height);

        for (const star of stars) {
            context.value.fillStyle = star.color;
            context.value.globalAlpha = star.opacity;

            const xDistance = star.x - canvasCenter.value.x;
            const yDistance = star.y - canvasCenter.value.y;
            const distanceFromCenter = Math.sqrt((xDistance * xDistance) + (yDistance * yDistance));

            star.angle += (Math.acos(1 - Math.pow(star.speed / distanceFromCenter, 2) / 2)) * delta;

            star.x = canvasCenter.value.x + distanceFromCenter * Math.cos(star.angle);
            star.y = canvasCenter.value.y + distanceFromCenter * Math.sin(star.angle);

            context.value.beginPath();
            context.value.arc(star.x, star.y, star.radius, 0, endAngle);
            context.value.fill();
        }
    };

    const onResize = () => {
        generateStars();
        canvasWidth.value = canvas.value.offsetWidth;
        canvasHeight.value = canvas.value.offsetHeight;
    };

    onMounted(() => {
        onResize();
        window.addEventListener('resize', onResize);

        animationFrame = requestAnimationFrame(loop);

        setTimeout(() => loaded.value = true, 0);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', onResize);

        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
            animationFrame = 0;
        }
    });
</script>

<style lang="scss" scoped>
    @import '~/master/variables';
    @import '~/master/mixins';

    .home-hero-component {
        background: black;
        text-align: center;
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
    }

    .copy-container {
        position: relative;
        z-index: 1;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 4rem 0 8rem 0;
        box-sizing: border-box;
    }

    h1, h2, h3, h4, h5, .fa-rocket-launch {
        color: white;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(2rem);
        display: block !important;

        &.loaded {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        color: white;
        font-size: 3rem;
        font-weight: 300;
        margin-bottom: 2rem;
        letter-spacing: 0.32rem;
        @include breakpoint-mobile {
            font-size: 2rem;
        }
    }

    h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 1rem;
        @include breakpoint-mobile {
            font-size: 1.25rem;
        }
    }

    h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        @include breakpoint-mobile {
            font-size: 1.25rem;
        }
    }

    @keyframes flying {
        0% { transform: translateY(-0.25rem); }
        50% { transform: translateY(0.25rem); }
        100% { transform: translateY(-0.25rem); }
    }

    .fa-rocket-launch {
        font-size: 2rem;
        animation: flying infinite 2s ease-in-out;
        @include breakpoint-mobile {
            font-size: 1.5rem;
        }
    }

    h4 {
        font-weight: 300;
        margin-bottom: 0;
    }

    h5 {
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 2rem;
    }

    canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .scroll-curve {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 8rem;
        transition: transform 0.5s ease;
        overflow: hidden;
    }

    svg {
        display: block;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        @include breakpoint-legacy {
            transform: scale(2);
            height: 8rem;
        }
        @include breakpoint-tablet {
            transform: scale(3);
        }
        @include breakpoint-mobile {
            transform: scale(6);
        }
    }

    svg path {
        fill: white;
        stroke: white;
    }

    .fa-computer-mouse-scrollwheel {
        color: black;
        font-size: 2rem;
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        animation-name: bounce;
        animation-duration: 1s;
        animation-direction: alternate;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
    }

    .v-enter-active, .v-leave-active {
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .v-enter-from, .v-leave-to {
        opacity: 0 !important;
        transform: translateY(2rem) !important;
    }

    @keyframes bounce {
        0% { transform: translate(-50%, 0); }
        100% { transform: translate(-50%, 0.5rem); }
    }
</style>
