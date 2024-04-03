<template>
    <div class="project-image-manager-component">
        <DropZone @drop="onDropFiles">
            <template v-slot:active>
                <div>Drop files here to upload</div>
            </template>

            <template v-slot:default>
                <ul class="pending image-list" v-if="images.length">
                    <li v-for="image in images">
                        <span class="fal fa-fw fa-times" aria-label="Remove pending image from uploads" @click="removePendingImage(image)"></span>

                        <div class="pending-image-container">
                            <div class="image-container">
                                <img class="preview" :src="image.preview || image.url" :alt="image.title" :draggable="false">
                            </div>

                            <div class="fields-container">
                                <div class="form-group">
                                    <button class="outline button" type="button" title="Move up" aria-label="Move up" @click="moveImageUp(image)" :disabled="!canMoveImageUp(image)">
                                        <span class="fal fa-fw fa-arrow-up"></span>
                                    </button>

                                    <button class="outline button" type="button" title="Move down" aria-label="Move down" @click="moveImageDown(image)" :disabled="!canMoveImageDown(image)">
                                        <span class="fal fa-fw fa-arrow-down"></span>
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>

                                    <input :id="image.titleField" :name="image.titleField" type="text" v-model="image.title">
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>

                                    <Editor :id="image.captionField" :name="image.captionField" v-model="image.caption" />
                                    <!-- <textarea :id="image.captionField" :name="image.captionField" v-model="image.caption"></textarea> -->
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <p v-else style="margin-bottom: 0;">
                    Drag image files here
                </p>
            </template>
        </DropZone>
    </div>
</template>

<script setup>
    import DropZone from '@/components/DropZone.vue';
    import Editor from '@/components/Editor.vue';
    import { randomString } from '@/helpers/strings';
    import { ref } from 'vue';

    class ProjectImage
    {
        constructor(file)
        {
            this.id = randomString();
            this.file = file;
            this.preview = URL.createObjectURL(file);
            this.title = '';
            this.caption = '';
            this.titleField = `images[${this.id}][title]`;
            this.captionField = `images[${this.id}][caption]`;
        }
    };

    const props = defineProps({
        modelValue: {
            type: Array,
            default: () => [],
        },
    });

    const images = ref(props.modelValue.slice());

    const onDropFiles = files => {
        images.value = [...images.value, ...files.map(file => new ProjectImage(file))];
    };

    const removePendingImage = imageToRemove => {
        images.value = images.value.filter(pendingImage => pendingImage !== imageToRemove);
    };

    const canMoveImageUp = image => images.value.indexOf(image) > 0;

    const canMoveImageDown = image => images.value.indexOf(image) < images.value.length - 1;

    const moveImageUp = image => {
        if (!canMoveImageUp(image)) return;

        const index = images.value.indexOf(image);
        const tempImages = images.value.filter(i => i !== image);

        tempImages.splice(index - 1, 0, image);

        images.value = tempImages;
    };

    const moveImageDown = image => {
        if (!canMoveImageDown(image)) return;

        const index = images.value.indexOf(image);
        const tempImages = images.value.filter(i => i !== image);

        tempImages.splice(index + 1, 0, image);

        images.value = tempImages;
    };

    defineExpose({ images });
</script>

<style lang="scss" scoped>
    @import '~/master/variables';

    :deep(.drop-zone-component) {
        padding: 2rem;
        border-radius: 0.25rem;
        background: white;
    }

    img {
        display: block;
        max-width: 100%;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    fieldset {
        padding: 1rem;
        border: 1px solid black;
        border-radius: 0.25rem;
    }

    legend {
        color: black;
        font-weight: 800;
        padding: 1rem 2rem;
        border: 1px solid black;
        border-radius: 0.25rem;
    }

    .image-list {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .pending.image-list {
        li {
            position: relative;
            box-shadow: $shadow;
            border-radius: 0.25rem;

            .fa-times {
                position: absolute;
                top: 0;
                right: 0;
                width: 2rem;
                height: 2rem;
                border-radius: 100%;
                background: white;
                border: 1px solid black;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                transform: translate(50%, -50%);
                box-shadow: $shadow;
            }
        }
    }

    .pending-image-container {
        display: flex;
    }

    .image-container {
        flex: 1;
    }

    .fields-container {
        flex: 1;
        padding: 2rem;
        box-shadow: 15px 0 20px -5px rgb(0 0 0 / 15%) inset, 5px 0 10px -5px rgb(0 0 0 / 25%) inset;
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        display: flex;
        flex-direction: column;

        .form-group:last-child {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        textarea {
            flex: 1;
        }
    }
</style>
