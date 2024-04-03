<template>
    <div class="drop-zone-component"
        :class="{ active }"
        @dragenter.prevent="() => setActive(true)"
        @dragover.prevent="() => setActive(true)"
        @dragleave.prevent="() => setActive(false)"
        @drop.prevent="onDrop"
    >
        <div class="active-overlay" v-if="active">
            <slot name="active">
                <p>Drop files here</p>
            </slot>
        </div>

        <div class="drop-zone-content">
            <slot />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';

    const emit = defineEmits([ 'drop' ]);

    let timeout = null;
    const setActiveDelay = 50;

    const active = ref(false);
    const setActive = value => {
        if (timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        if (value) {
            active.value = true;
        } else {
            timeout = setTimeout(() => active.value = false, setActiveDelay);
        }
    };

    const onDrop = e => {
        active.value = false;
        emit('drop', [...e.dataTransfer.files]);
    };
    const preventDefault = e => e?.preventDefault();

    const events = ['dragenter', 'dragover', 'dragleave', 'drop'];
    onMounted(() => {
        for (const event of events) {
            document.body.addEventListener(event, preventDefault);
        }
    });
    onUnmounted(() => {
        for (const event of events) {
            document.body.removeEventListener(event, preventDefault);
        }
    });
</script>

<style lang="scss" scoped>
    .drop-zone-component {
        position: relative;
        transition: border 0.25s ease;

        &.active {
            outline: 2px solid black;
        }

        .active-overlay {
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            background: rgb(0 0 0 / 50%);
        }

        .drop-zone-content {
            position: relative;
            z-index: 1;
        }
    }
</style>
