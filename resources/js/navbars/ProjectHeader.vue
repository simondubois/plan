<template>

    <bs-navbar>

        <li
            slot="center"
            class="navbar-brand"
        >
            {{ $t('project.index.title') }}
        </li>

        <li
            slot="right"
            class="nav-item"
        >
            <router-link
                :to="route"
                class="nav-link"
            >
                <fontawesome-icon icon="create" />
                <span class="d-none d-md-inline">
                    {{ $t('project.create.title') }}
                </span>
            </router-link>
        </li>

    </bs-navbar>

</template>



<script>

    export default {
        computed: {
            route: () => ({ name: 'project-create' }),
        },
    };

</script>
