<template>

    <div>
        <task-event
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            class="mb-2"
        />

        <div
            v-if="tasks.length"
            class="text-center small text-muted"
        >
            <fontawesome-icon icon="time" />
            {{ spentText }} / {{ estimatedText }}
        </div>

    </div>

</template>



<script>

    export default {
        computed: {
            estimated: vue => vue.tasks.reduce((total, task) => total + task.estimated_time, 0),
            estimatedText: vue => vue.minutesToString(vue.estimated),
            spent: vue => vue.tasks.reduce((total, task) => total + task.spent_time, 0),
            spentText: vue => vue.minutesToString(vue.spent),
            tasks: vue => vue.$store.getters['task/all'].filter(task => task.start === null),
        },
    };

</script>
