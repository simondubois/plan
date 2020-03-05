<template>

    <span v-if="completion === 100">
        <fontawesome-icon
            icon="valid"
            :class="'text-' + context"
        />
    </span>

    <span
        v-else-if="completion > 0"
        :class="'badge-' + context"
        class="badge"
    >
        {{ completion }}%
    </span>

</template>



<script>

    export default {
        props: {
            completion: {
                type: Number,
                required: true,
            },
        },
        computed: {
            context: vue => {
                if (vue.completion === 100) {
                    return 'success';
                }
                return 'dark';
            },
        },
    };

</script>
