<template>

    <span
        v-if="start && end && completion < 100"
        :class="'badge-' + context"
        class="badge"
    >
        <fontawesome-icon icon="date" />
        {{ text }}
    </span>

</template>



<script>

    export default {
        props: {
            completion: {
                type: Number,
                required: true,
            },
            end: {
                type: Object,
                default: null,
            },
            start: {
                type: Object,
                default: null,
            },
        },
        computed: {
            context: vue => {
                if (vue.end.isBefore(vue.today)) {
                    return 'danger';
                }
                if (vue.start.isAfter(vue.today)) {
                    return 'success';
                }
                return 'dark';
            },
            text: vue => {
                if (vue.start.isSame(vue.end)) {
                    return vue.start.format('ddd D MMM');
                }
                return vue.start.format('L') + ' - ' + vue.end.format('L');
            }
        },
    };

</script>
