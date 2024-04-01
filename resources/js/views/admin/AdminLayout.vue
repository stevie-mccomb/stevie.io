<template>
    <div class="admin layout">
        <div class="container">
            <div class="sidebar">
                <router-link :to="{ name: 'admin.projects.index' }">
                    <span class="icon">
                        <span class="fal fa-fw fa-list"></span>
                    </span>

                    Projects
                </router-link>

                <a href="/logout">
                    <span class="icon">
                        <span class="fal fa-fw fa-lock"></span>
                    </span>

                    Log Out
                </a>
            </div>

            <slot />
        </div>
    </div>
</template>

<script setup>
    if (!window?.User?.id) {
        const intended = encodeURIComponent(router.currentRoute.value.fullPath);
        router.push(`/login?intended=${intended}`);
    }
</script>

<style lang="scss" scoped>
    @import '~/master/variables';

    .admin.layout {
        flex: 1;
        background: darken(white, 10%);
    }

    .container {
        padding-top: 2rem;
        display: flex;
        gap: 2rem;
    }

    .sidebar {
        box-shadow: $shadow;
        height: fit-content;

        a {
            display: block;
            padding-right: 2rem;
            background: darken(white, 10%);
            color: black;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.25s ease;

            .icon {
                display: inline-block;
                padding: 1rem;
                background: white;
                margin-right: 1rem;
                border-right: 1px solid darken(white, 25%);
                transition: background 0.25s ease, color 0.25s ease;
            }

            &:hover {
                background: white;

                .icon {
                    color: white;
                    background: black;
                }
            }

            &.router-link-active {
                background: #00a6ef;

                .icon {
                    color: white;
                    background: black;
                    border-right-color: black;
                }
            }
        }
    }

    :deep(.sidebar + *) {
        flex: 1;
        margin-bottom: 2rem;
    }
</style>
