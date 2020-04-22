<template>

    <vue-draggable
        :list="tasks"
        :sort="false"
        animation="500"
        class="draggable-container"
        draggable=".card"
        group="task-calendar"
        @add="submit"
    >

        <task-event
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            class="mb-2 grabbable"
        />

        <div
            v-if="tasks.length"
            class="text-center small text-muted"
        >
            <fontawesome-icon icon="time" />
            {{ spentText }} / {{ estimatedText }}
        </div>

    </vue-draggable>

</template>



<script>

    export default {
        components: {
            'vue-draggable': require('vuedraggable'),
        },
        computed: {
            estimated: vue => vue.tasks.reduce((total, task) => total + task.estimated_time, 0),
            estimatedText: vue => vue.minutesToString(vue.estimated),
            spent: vue => vue.tasks.reduce((total, task) => total + task.spent_time, 0),
            spentText: vue => vue.minutesToString(vue.spent),
            tasks: vue => vue.$store.getters['task/leaves'](null).filter(task => task.start === null),
        },
        methods: {
            submit(event) {
                const task = this.tasks[event.newDraggableIndex];
                require('axios')
                    .put('api/tasks/' + task.id, { ...task, date: null })
                    .then(() => this.$emit('task:updated'));
            },
        },
    };

</script>



<style scoped>

    .draggable-container {
        min-height: 141px;
    }

</style>
