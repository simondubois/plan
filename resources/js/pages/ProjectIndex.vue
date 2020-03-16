<template>

    <div class="container">

        <transition-group
            v-if="projects.length"
            class="row"
            name="fade"
            tag="div"
            appear
        >
            <div
                v-for="project in projects"
                :key="project.id"
                class="col-xl-3 col-lg-4 col-sm-6 mb-4"
            >
                <project-card :project="project" />
            </div>
        </transition-group>

        <div
            v-else
            class="d-flex align-items-center justify-content-center h-100"
        >
            <p class="text-muted">
                {{ $t('project.index.empty') }}
            </p>
        </div>

        <transition
            mode="out-in"
            name="fade"
            appear
        >
            <router-view
                v-bind="[$route.params, $route.query]"
                @project:stored="fetchProjects"
                @project:updated="fetchProjects"
            />
        </transition>

    </div>

</template>



<script>

    export default {
        data: () => ({
            projects: [],
        }),
        created() {
            this.fetchProjects();
        },
        methods: {
            fetchProjects() {
                require('axios')
                    .get('api/projects')
                    .then(response => this.projects = response.data.data.map(project => ({
                        ...project,
                        end: project.end ? require('dayjs')(project.end).startOf('day') : null,
                        start: project.start ? require('dayjs')(project.start).startOf('day') : null,
                    })));
            },
        },
    };

</script>
