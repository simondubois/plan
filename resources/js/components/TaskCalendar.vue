<template>

    <div class="container-fluid h-100">
        <div class="d-flex h-100">

            <div
                class="col overflow-auto"
                :style="{ 'flex-grow': showWeekends ? 7 : 5 }"
            >
                <task-week
                    v-for="(week, index) in weeks"
                    :key="week.valueOf()"
                    :class="{ 'border-top': index }"
                    :show-weekends="showWeekends"
                    :week="week"
                    @task:updated="$emit('task:updated')"
                />
            </div>

            <div class="col overflow-auto border-left">
                <task-unplanned @task:updated="$emit('task:updated')" />
            </div>

        </div>
    </div>

</template>



<script>

    export default {
        computed: {
            dates: vue => vue.$store.getters['task/all'].map(task => task.start).filter(date => date !== null),
            max: vue => vue.dates.reduce((max, date) => date.isAfter(max) ? date : max, vue.today).endOf('isoWeek'),
            min: vue => vue.dates.reduce((min, start) => start.isBefore(min) ? start : min, vue.today).startOf('isoWeek'),
            showWeekends: vue => vue.dates.filter(date => date.day() === 0 || date.day() === 6).length > 0,
            weeks: vue => new Array(Math.ceil(vue.max.diff(vue.min, 'week', true)) + 1)
                .fill(undefined)
                .map((value, index) => vue.min.add(index, 'week')),
        },
    };

</script>
