<template>

    <vue-draggable
        :class="{ 'bg-white' : isToday }"
        :list="tasks"
        :sort="false"
        animation="500"
        class="d-flex flex-column p-2"
        draggable=".card"
        group="task-calendar"
        @add="submit"
    >

        <task-event
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            class="my-2 grabbable"
        />

        <div
            slot="header"
            :class="{ 'font-weight-bold' : isToday, 'text-muted': isPast }"
            class="text-truncate"
        >
            {{ date }}
        </div>

        <div
            v-if="tasks.length"
            slot="footer"
            class="text-center small text-muted"
        >
            <fontawesome-icon icon="time" />
            {{ estimatedText }}
        </div>

    </vue-draggable>

</template>



<script>

    export default {
        components: {
            'vue-draggable': require('vuedraggable'),
        },
        props: {
            day: {
                type: Object,
                required: true,
            },
        },
        computed: {
            date: vue => vue.day.format('ddd D MMM'),
            estimated: vue => vue.tasks.reduce((total, task) => total + task.estimated_time, 0),
            estimatedText: vue => vue.minutesToString(vue.estimated),
            isPast: vue => vue.today.isAfter(vue.day),
            isToday: vue => vue.today.isSame(vue.day),
            spent: vue => vue.tasks.reduce((total, task) => total + task.spent_time, 0),
            spentText: vue => vue.minutesToString(vue.spent),
            tasks: vue => vue.$store.getters['task/leaves'](null).filter(task => task.start && task.start.isSame(vue.day)),
        },
        methods: {
            submit(event) {
                const task = this.tasks[event.newDraggableIndex];
                if (task) {
                    require('axios')
                        .put('api/tasks/' + task.id, { ...task, date: this.day.format('YYYY-MM-DD') })
                        .then(() => this.$emit('task:updated'));
                }
            },
        },
    };

</script>



<style scoped>

    .d-flex {
        min-height: 141px;
    }

</style>
