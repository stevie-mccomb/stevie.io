<template>
    <div class="unknown view">
        <section>
            <div class="container">
                <h1>
                    Uh oh! It looks like something went wrong.
                </h1>

                <p>
                    An unknown error has occurred. If the issue persists, <router-link :to="{ name: 'contact' }">send us a message</router-link> to let us know!
                </p>

                <a href="/">
                    <span class="fal fa-angle-left"></span> Take me home
                </a>
            </div>
        </section>
    </div>
</template>

<style lang="scss" scoped>
    section {
        padding: 4rem 0;
    }

    h1 {
        font-size: 3rem;
    }

    p {
        font-size: 1.5rem;
    }
</style>
