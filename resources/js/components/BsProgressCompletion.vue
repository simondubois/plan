<template>

    <div class="d-flex align-items-center">

        <fontawesome-icon
            icon="completion"
            class="mr-1 text-muted"
        />

        <div class="progress w-100">
            <div
                :class="'bg-' + context"
                class="progress-bar"
                :style="{ width }"
            />
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
        },
        computed: {
            context: vue => vue.completion === 100 ? 'success' : 'dark',
            width: vue => vue.completion + '%',
        },
    };

</script>
