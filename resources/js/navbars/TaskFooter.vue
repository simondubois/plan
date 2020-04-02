<template>

    <bs-navbar>

        <template slot="left">

            <li class="nav-item">
                <router-link
                    :to="listRoute"
                    class="nav-link"
                    exact
                >
                    <fontawesome-icon icon="task-list" />
                </router-link>
            </li>

            <li class="nav-item">
                <router-link
                    :to="calendarRoute"
                    class="nav-link"
                    exact
                >
                    <fontawesome-icon icon="task-calendar" />
                </router-link>
            </li>

            <li class="nav-item">
                <router-link
                    :to="horizontalRoute"
                    class="nav-link"
                    exact
                >
                    <fontawesome-icon icon="task-horizontal" />
                </router-link>
            </li>

            <li class="nav-item">
                <router-link
                    :to="verticalRoute"
                    class="nav-link"
                    exact
                >
                    <fontawesome-icon icon="task-vertical" />
                </router-link>
            </li>

        </template>

        <template slot="right">

            <li class="nav-item">
                <router-link
                    :to="createRoute"
                    class="nav-link"
                >
                    <fontawesome-icon icon="create" />
                    {{ $t('task.create.titleRoot') }}
                </router-link>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    href="#"
                    @click.prevent="openHelp"
                >
                    <fontawesome-icon icon="help" />
                    <span class="d-none d-md-inline">
                        {{ $t('help.modal.title') }}
                    </span>
                </a>
            </li>

        </template>

        <help-modal
            slot="outside"
            :is-open="isHelpOpen"
            @modal:close="closeHelp"
        />

    </bs-navbar>

</template>



<script>

    export default {
        data: () => ({
            isHelpOpen: false,
        }),
        computed: {
            calendarRoute: vue => ({ name: 'task-index', query: { ...vue.$route.query, taskView: 'calendar' } }),
            createRoute: vue => ({ name: 'task-create', query: { ...vue.$route.query, parentId: null } }),
            horizontalRoute: vue => ({ name: 'task-index', query: { ...vue.$route.query, taskView: 'horizontal' } }),
            listRoute: vue => ({ name: 'task-index', query: { ...vue.$route.query, taskView: 'list' } }),
            verticalRoute: vue => ({ name: 'task-index', query: { ...vue.$route.query, taskView: 'vertical' } }),
        },
        methods: {
            closeHelp() {
                this.isHelpOpen = false;
            },
            openHelp() {
                this.isHelpOpen = true;
            },
        },
    };

</script>
