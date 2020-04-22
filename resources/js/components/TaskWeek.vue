<template>

    <div class="row">
        <task-day
            v-for="day in days"
            :key="day.valueOf()"
            :day="day"
            class="flex-fill"
            @task:updated="$emit('task:updated')"
        />
    </div>

</template>



<script>

    export default {
        props: {
            showWeekends: {
                type: Boolean,
                default: false,
            },
            week: {
                type: Object,
                required: true,
            },
        },
        computed: {
            days: vue => new Array(vue.showWeekends ? 7 : 5)
                .fill(undefined)
                .map((value, index) => vue.week.startOf('isoWeek').add(index, 'day')),
        },
    };

</script>



<style scoped>

    .flex-fill {
        flex-basis: 0 !important;
        min-width: 0px;
    }

</style>
