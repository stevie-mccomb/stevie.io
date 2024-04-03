<template>
    <div class="carousel" ref="root" tabindex="0" :data-background-color="backgroundColor">
        <div ref="rack" class="rack" :style="{ width: `${slides.length * 100}%`, marginLeft: `-${currentSlideIndex * 100}%` }">
            <slot></slot>
        </div>

        <fieldset aria-label="carousel buttons" class="controls" aria-controls="carousel">
            <button value="pause" id="pause" aria-label="pause" class="carousel-button" v-if="!paused" @click="pause" ref="toggleButton">
                <span class="fal fa-fw fa-pause"></span>
            </button>

            <button value="play" class="carousel-button" @click="play" v-if="paused">
                <span class="fal fa-fw fa-play"></span>
            </button>

            <button value="beginning" aria-label="jump to beginning" class="carousel-button" @click="beginning" :disabled="!canGoPrevious">
                <span class="fal fa-fw fa-backward-step"></span>
            </button>

            <button value="previous" aria-label="previous" class="carousel-button" @click="previous" :disabled="!canGoPrevious">
                <span class="fal fa-fw fa-chevron-left"></span>
            </button>

            <div class="index-controls">
                <span class="pseudo-input" tabindex="0" contenteditable aria-role="textbox" aria-multiline="false" @focus="onInputFocus" @input="onInput" ref="input">
                    {{ currentSlideIndex + 1 }}
                </span>

                <span class="divider">
                    /
                </span>

                <span class="total-slide-count">
                    {{ slides.length }}
                </span>
            </div>

            <button value="next" aria-label="next" class="carousel-button" @click="next" :disabled="!canGoNext">
                <span class="fal fa-fw fa-chevron-right"></span>
            </button>

            <button value="end" aria-label="jump to end" class="carousel-button" @click="end" :disabled="!canGoNext">
                <span class="fal fa-fw fa-forward-step"></span>
            </button>
        </fieldset>
    </div>
</template>

<script setup>
    import { cursorToEnd, selectElementContents } from '@/helpers/selection';
    import { computed, onMounted, ref, watch } from 'vue';

    const props = defineProps({
        auto: {
            type: Boolean,
            default: true
        },

        backgroundColor: {
            type: String,
            default: 'grey'
        },

        interval: {
            type: Number,
            default: 10000
        }
    });

    const currentSlideIndex = ref(0);
    const root = ref(null);
    const rack = ref(null);
    const slideTemplate = ref(null);
    const toggleButton = ref(null);
    const input = ref(null);
    const timeout = ref(0);

    const slides = computed(() => !!root.value ? root.value.querySelectorAll('.rack > *') : []);
    const canGoPrevious = computed(() => currentSlideIndex.value > 0);
    const canGoNext = computed(() => currentSlideIndex.value < slides.value.length - 1);

    const paused = ref(!props.auto);
    const pause = () => {
        paused.value = true;
        if (timeout.value) {
            clearTimeout(timeout.value);
        }
    };
    const play = () => paused.value = false;
    const toggle = () => paused.value = !paused.value;

    const beginning = () => {
        pause();
        currentSlideIndex.value = 0;
    };

    const end = () => {
        pause();
        currentSlideIndex.value = slides.value.length - 1;
    };

    const previous = auto => {
        pause();
        if (!canGoPrevious.value) return;
        if (--currentSlideIndex.value < 0) currentSlideIndex.value = slides.value.length - 1;
    };

    const next = auto => {
        if (auto !== true) pause();
        if (!canGoNext.value && !auto) return;

        if (timeout.value) {
            clearTimeout(timeout.value);
            timeout.value = 0;
        }

        if (++currentSlideIndex.value > slides.value.length - 1) currentSlideIndex.value = 0;

        if (!paused.value) {
            timeout.value = setTimeout(next.bind(this, true), props.interval);
        }
    };

    const setSlideAriaVisibility = () => {
        for (const [index, slide] of slides.value.entries()) {
            slide.setAttribute('aria-hidden', index !== currentSlideIndex.value);
        }
    };

    const onInputFocus = e => selectElementContents(input.value);

    const onInput = e => {
        let value = parseInt(input.value.innerText.replace(/\D/, ''));
        if (isNaN(value)) value = 1;
        value = value.clamp(1, slides.value.length);

        currentSlideIndex.value = value - 1;
        input.value.innerText = value;

        input.value.innerText.length > 1 ? cursorToEnd(input.value) : selectElementContents(input.value);
        pause();
    };

    const onKeyUp = e => {
        const leftArrow = 37;
        const rightArrow = 39;
        const a = 65;
        const d = 68;
        const space = 32;
        const enter = 13;
        const j = 74;
        const k = 75;
        const l = 76;

        if (document.activeElement !== input.value) {
            switch (e.keyCode) {
                case a:
                case j:
                case leftArrow:
                    (e.shiftKey || e.ctrlKey) ? beginning() : previous();
                    break;

                case d:
                case l:
                case rightArrow:
                    (e.shiftKey || e.ctrlKey) ? end() : next();
                    break;

                case k:
                case space:
                case enter:
                    if (document.activeElement === root.value || document.activeElement === toggleButton.value) toggle();
                    break;

                default:
                    break;
            }
        }
    };

    watch(paused, value => {
        if (!value) {
            timeout.value = setTimeout(next.bind(this, true), props.interval);
        } else {
            clearTimeout(timeout.value);
            timeout.value = 0;
        }
    });

    watch(currentSlideIndex, setSlideAriaVisibility);

    onMounted(() => {
        if (props.auto) {
            timeout.value = setTimeout(next.bind(this, true), props.interval);
        }

        setSlideAriaVisibility();

        root.value.addEventListener('keyup', onKeyUp);
    });
</script>

<style lang="scss" scoped>
    .carousel {
        display: flex;
        flex-direction: column;
        overflow: hidden;

        &.image-carousel-fixed {
            .image-container, .summary-container {
                flex: 1;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .image-container {
                display: flex;
                align-items: center;
                background: #282828;
            }

            .summary-container {
                align-items: flex-start;
            }

            &[data-background-color="white"] .image-container {
                background: white;
            }

            &[data-background-color="black"] .image-container {
                background: black;
            }
        }
    }

    .rack {
        display: flex;
        border-bottom: 2px solid black;
        transition: margin-left 0.5s ease;

        &:deep(> *) {
            flex: 1;
        }

        figure {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            max-width: 100%;
        }
    }

    .controls {
        display: flex;
        align-self: center;
        border: 2px solid black;
        width: fit-content;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        margin-top: -2px;
        padding: 0.5rem;

        > * {
            display: block;
            padding: 0.5rem;
        }

        .pseudo-input, .total-slide-count {
            display: inline-block;
            padding: 0.5rem;
            text-align: center;
            border-bottom: 1px solid black;
        }

        .total-slide-count {
            border-color: transparent;
        }

        button {
            cursor: pointer;
            color: black;
            background: white;
            border: 0;
            font-size: 1rem;

            &:focus {
                outline-color: #00a6ef;
            }

            &:disabled {
                opacity: 0.25;
            }
        }
    }
</style>
