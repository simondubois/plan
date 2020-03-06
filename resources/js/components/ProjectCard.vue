<template>

    <div
        class="card"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="card-header">
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
    };

</script>
