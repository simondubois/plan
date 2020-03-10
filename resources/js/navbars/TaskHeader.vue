<template>

    <bs-navbar>

        <li
            slot="left"
            class="nav-item"
        >
            <router-link
                :to="route"
                class="nav-link"
            >
                <fontawesome-icon icon="previous" />
                <span class="d-none d-md-inline">
                    {{ $t('project.index.title') }}
                </span>
            </router-link>
        </li>

        <li
            slot="center"
            class="nav-item"
        >
            <span class="navbar-brand">
                {{ project.name }}
            </span>
        </li>

        <template slot="right">

            <li class="nav-item d-none d-sm-inline">
                <span class="navbar-text">
                    <bs-badge-completion :completion="project.completion" />
                </span>
            </li>

            <li class="nav-item d-none d-sm-inline">
                <span class="navbar-text">
                    <bs-badge-date
                        :completion="project.completion"
                        :end="project.end"
                        :start="project.start"
                    />
                </span>
            </li>

            <li class="nav-item d-none d-sm-inline">
                <span class="navbar-text">
                    <bs-badge-time
                        :completion="project.completion"
                        :estimated="project.estimated_time"
                        :spent="project.spent_time"
                    />
                </span>
            </li>

        </template>

    </bs-navbar>

</template>



<script>

    export default {
        props: {
            projectId: {
                type: [Number, String],
                required: true,
            },
        },
        data: () => ({
            project: {
                estimated_time: 0,
                completion: 0,
                spent_time: 0,
            },
        }),
        computed: {
            route: () => ({ name: 'project-index' }),
        },
        watch: {
            projectId: 'fetchProject',
        },
        methods: {
            fetchProject() {
                require('axios')
                    .get('api/projects/' + this.projectId)
                    .then(response => this.project = {
                        ...response.data.data,
                        end: response.data.data.end ? require('dayjs')(response.data.data.end).startOf('day') : null,
                        start: response.data.data.start ? require('dayjs')(response.data.data.start).startOf('day') : null,
                    });
            },
        },
    };

</script>
