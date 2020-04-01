<template>

    <div
        :class="'border-' + context + ' text-' + context"
        class="card"
        @mouseover="hovered = true"
        @mouseleave="hovered = false"
    >

        <div class="card-header">

            <bs-badge-completion :completion="task.completion" />

            <template v-if="parentName">
                {{ parentName }} >
            </template>

            {{ task.code }}. {{ task.name }}

            <transition name="fade">
                <router-link
                    v-if="hovered"
                    :title="$t('task.edit.title')"
                    :to="editRoute"
                    class="mx-1"
                >
                    <fontawesome-icon icon="edit" />
                </router-link>
            </transition>

            <div class="text-center">
                <bs-badge-time
                    :completion="task.completion"
                    :estimated="task.estimated_time"
                    :spent="task.spent_time"
                    class="m-1"
                />
            </div>

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
            editRoute: vue => ({ name: 'task-edit', params: { taskId: vue.task.id }, query: vue.$route.query }),
            parent: vue => vue.$store.getters['task/find'](vue.task.parent_id),
            parentName: vue => vue.parent ? vue.parent.name : undefined,
        },
    };

</script>
