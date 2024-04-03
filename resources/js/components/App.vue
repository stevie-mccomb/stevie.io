<template>
    <a class="main-content-skip" href="#main-content">
        Skip to main content
    </a>

    <Transition>
        <!-- <AppHeader ref="appHeader" v-if="!headerless"></AppHeader> -->
        <AppHeader ref="appHeader" :headerless="headerless"></AppHeader>
    </Transition>

    <main :style="{ transform }">
        <a name="main-content"></a>

        <div class="view-container">
            <router-view v-if="status === 200"></router-view>

            <component v-else :is="errorComponent"></component>
        </div>
    </main>
</template>

<script setup>
    import AppHeader from '@/components/AppHeader.vue';
    import useErrors from '@/composables/useErrors';
    import { computed, nextTick, ref, watch } from 'vue';
    import { useRoute } from 'vue-router';

    const { status, errorComponent } = useErrors();
    const route = useRoute();

    const appHeader = ref(null);
    const headerless = ref(true);

    // const paddingTop = computed(() => (headerless.value ? '' : `${appHeader.value?.$el.offsetHeight}px`));
    const offsetTop = computed(() => (headerless.value ? `${appHeader.value?.$el.offsetHeight}` : 0));
    const transform = ref('translateY(0)');

    const onScroll = e => {
        if (window.scrollY <= 0) {
            if (route.meta?.headerless) headerless.value = true;
            transform.value = `translateY(-${appHeader.value?.$el?.offsetHeight || 0}px)`;
        } else {
            headerless.value = false;
            transform.value = 'translateY(0)';
        }
    };

    watch(route, newRoute => {
        headerless.value = newRoute.meta?.headerless;
        if (newRoute.meta?.headerless) {
            onScroll();
            window.addEventListener('scroll', onScroll);
        } else {
            window.removeEventListener('scroll', onScroll);
        }
    });
</script>

<style lang="scss" scoped>
    .v-enter-active, .v-leave-active {
        position: absolute;
        width: 100%;
        z-index: 2;
        transition: transform 0.5s ease;
    }

    .v-enter-from, .v-leave-to {
        transform: translateY(-100%);
    }

    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease;
    }

    .view-container {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
</style>
