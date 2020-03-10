<template>

    <li
        class="list-group-item bg-transparent"
        :class="'text-' + context"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="d-flex justify-content-between align-items-center">

            <div class="text-truncate">
                {{ task.code }}. {{ task.name }}
            </div>

            <div :class="hasChildren && hovered === false ? 'faded' : 'unfaded'">

                <bs-badge-date
                    :completion="task.completion"
                    :dates="dates"
                    :end="task.end"
                    :start="task.start"
                    :weights="estimations"
                    class="mx-1"
                />

                <bs-badge-time
                    :completion="task.completion"
                    :estimated="task.estimated_time"
                    :spent="task.spent_time"
                    class="mx-1"
                />

                <bs-badge-completion :completion="task.completion" />

            </div>

        </div>

        <task-list
            v-if="hasChildren"
            :parent-id="task.id"
        />

    </li>

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
            dates: vue => vue.$store.getters['task/leaves'](vue.task.id).map(task => task.start),
            estimations: vue => vue.$store.getters['task/leaves'](vue.task.id).map(task => task.estimated_time),
            hasChildren: vue => vue.$store.getters['task/children'](vue.task.id).length > 0,
        },
    };

</script>



<style lang="scss" scoped>

    .list-group-item {

        padding-right: 0px;

        .d-flex {

            padding-right: 1.25rem;

            :first-child {
                min-width: 0;
            }

            :last-child {
                white-space: nowrap;
            }

        }

    }

</style>
