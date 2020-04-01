<template>

    <li
        class="list-group-item bg-transparent"
        :class="'text-' + context"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <transition name="fade">
                    <div
                        v-if="hovered"
                        class="float-right ml-1"
                    >

                        <router-link
                            :title="$t('task.edit.title')"
                            :to="editRoute"
                            class="mx-1"
                        >
                            <fontawesome-icon icon="edit" />
                        </router-link>

                        <router-link
                            :title="$t('task.create.titleChild')"
                            :to="createRoute"
                            class="mx-1"
                        >
                            <fontawesome-icon icon="create" />
                        </router-link>

                    </div>
                </transition>

                <div class="text-truncate">
                    {{ task.code }}. {{ task.name }}
                </div>

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
            createRoute: vue => ({ name: 'task-create', query: { ...vue.$route.query, parentId: vue.task.id } }),
            dates: vue => vue.$store.getters['task/leaves'](vue.task.id).map(task => task.start),
            editRoute: vue => ({ name: 'task-edit', params: { taskId: vue.task.id }, query: vue.$route.query }),
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
