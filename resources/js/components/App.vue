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
</style>

<template>
    <a class="main-content-skip" href="#main-content">
        Skip to main content
    </a>

    <Transition>
        <AppHeader ref="appHeader" v-if="!headerless"></AppHeader>
    </Transition>

    <main>
        <a name="main-content"></a>

        <div class="view-container" :style="{ paddingTop }">
            <router-view></router-view>
        </div>
    </main>
</template>

<script setup>
    import AppHeader from '@/components/AppHeader.vue';
    import { computed, ref, watch } from 'vue';
    import { useRoute } from 'vue-router';

    const appHeader = ref(null);
    const paddingTop = computed(() => (headerless.value ? '' : `${appHeader.value?.$el.offsetHeight}px`));

    const route = useRoute();
    const headerless = ref(true);
    watch(route, newRoute => headerless.value = newRoute.meta?.headerless);
</script>
