<template>

    <div
        :class="'border-' + context + ' text-' + context"
        class="card"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="card-header">
            <div class="text-center text-truncate">
                <bs-badge-completion
                    v-if="hasChildren === false"
                    :completion="task.completion"
                />
                {{ task.code }}. {{ task.name }}
            </div>
        </div>

        <div class="card-body text-center">

            <bs-progress-completion
                v-if="hasChildren"
                :completion="task.completion"
                class="m-1"
            />

            <component
                :is="timeComponent"
                :completion="task.completion"
                :estimated="task.estimated_time"
                :spent="task.spent_time"
                class="m-1"
            />

            <component
                :is="dateComponent"
                :completion="task.completion"
                :dates="dates"
                :end="task.end"
                :start="task.start"
                :weights="estimations"
                class="m-1"
            />

        </div>

    </div>

</template>



<script>

    export default {
        props: {
            task: {
                type: Object,
                required: true,
            },
        },
        data: () => ({
            hovered: false,
        }),
        computed: {
            context: vue => {
                if (vue.task.completion === 100) {
                    return 'success';
                }
                if (vue.task.completion > 0) {
                    return 'dark';
                }
                return 'muted';
            },
            dateComponent: vue => vue.hasChildren ? 'bs-progress-date' : 'bs-badge-date',
            dates: vue => vue.$store.getters['task/leaves'](vue.task.id).map(task => task.start),
            estimations: vue => vue.$store.getters['task/leaves'](vue.task.id).map(task => task.estimated_time),
            hasChildren: vue => vue.$store.getters['task/children'](vue.task.id).length > 0,
            timeComponent: vue => vue.hasChildren ? 'bs-progress-time' : 'bs-badge-time',
        },
    };

</script>



<style scoped>

    .card {
        width: 250px;
    }

</style>
