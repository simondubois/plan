<template>

    <div
        class="card"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="card-header">

            <transition name="fade">
                <div
                    v-if="hovered"
                    class="float-right ml-1"
                >
                    <router-link
                        :title="$t('project.edit.title')"
                        :to="editRoute"
                        class="m-1"
                    >
                        <fontawesome-icon icon="edit" />
                    </router-link>
                </div>
            </transition>

            <div class="text-truncate text-center">
                {{ project.name }}
            </div>

        </div>

        <div class="card-body">

            <bs-progress-completion
                :completion="project.completion"
                class="my-1"
            />

            <bs-progress-date
                :completion="project.completion"
                :end="project.end"
                :start="project.start"
                class="my-1"
            />

            <bs-progress-time
                :completion="project.completion"
                :estimated="project.estimated_time"
                :spent="project.spent_time"
                class="my-1"
            />

        </div>

    </div>

</template>



<script>

    export default {
        props: {
            project: {
                type: Object,
                required: true,
            },
        },
        data: () => ({
            hovered: false,
        }),
        computed: {
            editRoute: vue => ({ name: 'project-edit', params: { projectId: vue.project.id } }),
        },
    };

</script>
