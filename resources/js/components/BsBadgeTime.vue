<template>

    <span
        v-if="estimated || spent"
        :class="'badge-' + context"
        class="badge"
    >
        <fontawesome-icon icon="time" />
        {{ spentText }} / {{ estimatedText }}
    </span>

</template>



<script>

    export default {
        props: {
            completion: {
                type: Number,
                required: true,
            },
            estimated: {
                type: Number,
                required: true,
            },
            spent: {
                type: Number,
                required: true,
            },
        },
        computed: {
            context: vue => {
                if (vue.spent > vue.estimated) {
                    return 'danger';
                }
                if (vue.completion === 100) {
                    return 'success';
                }
                if (vue.spent === 0) {
                    return 'light';
                }
                return 'dark';
            },
            estimatedText: vue => vue.minutesToString(vue.estimated),
            spentText: vue => vue.minutesToString(vue.spent),
        },
    };

</script>
