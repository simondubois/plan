<template>

    <div class="p-4">

        <component
            :is="'task-' + taskView"
            v-if="tasks.length"
        />

        <div
            v-else
            class="d-flex align-items-center justify-content-center h-100"
        >
            <p class="text-muted">
                {{ $t('task.index.empty') }}
            </p>
        </div>

        <transition
            mode="out-in"
            name="fade"
            appear
        >
            <router-view
                v-bind="[$route.params, $route.query]"
                @task:stored="fetchTasks"
                @task:updated="fetchTasks"
            />
        </transition>

    </div>

</template>



<script>

    export default {
        props: {
            projectId: {
                type: [Number, String],
                required: true,
            },
            taskView: {
                type: String,
                validator: taskView => ['calendar', 'horizontal', 'list', 'vertical'].includes(taskView),
                default: 'list',
            },
        },
        computed: {
            tasks: vue => vue.$store.getters['task/children'](null),
        },
        watch: {
            projectId: {
                handler: 'fetchTasks',
                immediate: true,
            },
        },
        created() {
            if (this.$route.query.taskView !== this.taskView) {
                this.$router.replace({
                    ...this.$route,
                    query: { ...this.$route.query, taskView: this.taskView },
                });
            }
        },
        methods: {
            fetchTasks() {
                this.$root.$refs.header.fetchProject();
                this.$store.dispatch('task/fetch', this.projectId);
            },
        },
    };

</script>
