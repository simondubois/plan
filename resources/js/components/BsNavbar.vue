<template>

    <div>

        <nav class="navbar navbar-dark bg-dark">
            <div class="container navbar-expand flex-nowrap overflow-hidden">

                <ul class="navbar-nav">
                    <slot name="left" />
                </ul>

                <ul class="navbar-nav justify-content-around">
                    <slot name="center" />
                </ul>

                <ul class="navbar-nav justify-content-end">

                    <li
                        :class="{ invisible: !loading }"
                        class="nav-item"
                    >
                        <span class="navbar-text">
                            <fontawesome-icon
                                icon="sync"
                                spin
                            />
                        </span>
                    </li>

                    <slot name="right" />

                </ul>

            </div>
        </nav>

        <slot name="outside" />

    </div>

</template>



<script>

    export default {
        computed: {
            loading: vue => vue.$store.getters['state/loading'],
        },
    };

</script>



<style scoped>

    .navbar-nav {
        flex-grow: 1;
        flex-basis: 0;
    }

</style>
