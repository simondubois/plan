<template>

    <div
        v-if="projectStart && projectEnd && completion < 100"
        class="d-flex align-items-center"
    >

        <fontawesome-icon
            icon="date"
            class="mr-1 text-muted"
        />

        <div class="progress w-100">
            <div
                v-for="({ date, context, weight }, index) in days"
                :key="date.valueOf()"
                :style="{ 'flex-grow': weight || defaultWeight }"
                :class="['bg-' + context, { 'border-left': index && dates.length && days.length < 10 }]"
                class="progress-bar align-items-center border-light text-light"
            >
                <fontawesome-icon
                    v-if="date.isSame(today) && dates.length && days.length < 10"
                    icon="today"
                />
            </div>
        </div>

    </div>

</template>



<script>

    export default {
        props: {
            completion: {
                type: Number,
                required: true,
            },
            dates: {
                type: Array,
                default: () => [],
            },
            end: {
                type: Object,
                default: null,
            },
            start: {
                type: Object,
                default: null,
            },
            weights: {
                type: Array,
                default: () => [],
            },
        },
        computed: {
            days: vue => [
                ...vue.daysBeforePeriod,
                ...vue.daysDuringPeriod,
                ...vue.daysAfterPeriod,
            ],
            daysAfterPeriod: vue =>
                new Array(Math.max(0, vue.today.diff(vue.projectEnd, 'day')))
                    .fill(undefined)
                    .map((date, index) => ({
                        context: 'danger',
                        date: vue.projectEnd.add(index + 1, 'days'),
                    })),
            daysBeforePeriod: vue =>
                new Array(Math.max(0, vue.projectStart.diff(vue.today, 'day')))
                    .fill(undefined)
                    .map((date, index) => ({
                        context: 'success',
                        date: vue.today.add(index, 'days'),
                    })),
            daysDuringPeriod: vue =>
                vue.start && vue.end && vue.dates.length === 0 ?
                    vue.daysDuringPeriodFromBoundaries : vue.daysDuringPeriodFromList,
            daysDuringPeriodFromBoundaries: vue =>
                new Array(Math.max(0, vue.end.diff(vue.start, 'day')))
                    .fill(undefined)
                    .map((date, index) => vue.start.add(index, 'days'))
                    .map(date => ({
                        context: date.isBefore(vue.today) || date.isSame(vue.today) ? 'dark' : 'transparent',
                        date,
                        weight: 1,
                    })),
            daysDuringPeriodFromList: vue =>
                vue.dates
                    .filter(date => date)
                    .reduce((days, date) => {
                        if (days.every(day => date.isSame(day) === false)) {
                            days.push(date);
                        }
                        return days;
                    }, [])
                    .sort((a, b) => a.diff(b, 'days'))
                    .map(date => ({
                        context: date.isBefore(vue.today) || date.isSame(vue.today) ? 'dark' : 'transparent',
                        date,
                        weight: vue.weights
                            .filter((weight, index) => vue.dates[index] && vue.dates[index].isSame(date))
                            .reduce((total, weight) => total + weight, 0) || 1,
                    })),
            defaultWeight: vue => vue.totalWeight / vue.daysDuringPeriod.length,
            projectEnd: vue => vue.end || vue.dates.filter(date => date).reduce((end, date) => end === null || end.isBefore(date) ? date : end, null),
            projectStart: vue => vue.start || vue.dates.filter(date => date).reduce((start, date) => start === null || start.isAfter(date) ? date : start, null),
            totalWeight: vue => vue.daysDuringPeriod.reduce((total, { weight }) => total + weight, 0),
        },
    };

</script>



<style scoped>

    .progress-bar {
        flex-basis: 0;
    }

</style>
