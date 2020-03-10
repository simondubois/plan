<template>

    <div
        :class="{ 'bg-white' : isToday }"
        class="d-flex flex-column p-2"
    >

        <div
            :class="{ 'font-weight-bold' : isToday, 'text-muted': isPast }"
            class="text-truncate"
        >
            {{ date }}
        </div>

        <div
            v-if="tasks.length"
            class="text-center small text-muted"
        >
            <fontawesome-icon icon="time" />
            {{ estimatedText }}
        </div>

        <task-event
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            class="my-2"
        />

    </div>

</template>



<script>

    export default {
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
    };

</script>
