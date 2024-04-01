<template>
    <div class="auth layout">
        <div class="container">
            <form method="POST" @submit.prevent="submit">
                <header v-if="$slots.header">
                    <slot name="header"></slot>
                </header>

                <section>
                    <slot></slot>
                </section>

                <footer v-if="$slots.footer">
                    <slot name="footer"></slot>
                </footer>
            </form>
        </div>
    </div>
</template>

<script setup>
    const emit = defineEmits([ 'submit' ]);

    const submit = e => emit('submit', e);
</script>

<style lang="scss" scoped>
    @import '~/master/variables';

    .auth.layout {
        flex: 1;
        background: darken(white, 10%);
    }

    form {
        margin: 2rem auto 0 auto;
        display: block;
        max-width: 32rem;
        border-radius: 1rem;
        box-shadow: $shadow;
        background: white;
    }

    header, section, footer {
        padding: 1rem 2rem;
    }

    header {
        border-bottom: 1px solid darken(white, 10%);

        :deep(h1, h2, h3, h4, h5, h6) {
            margin-bottom: 0;
        }
    }

    section {
        padding: 2rem;
    }

    footer {
        border-top: 1px solid darken(white, 10%);
    }
</style>
