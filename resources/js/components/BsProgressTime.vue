<template>

    <div
        v-if="estimated || spent"
        class="d-flex align-items-center"
    >

        <fontawesome-icon
            icon="time"
            class="mr-1 text-muted"
        />

        <div class="progress w-100">

            <div
                class="progress-bar bg-success"
                :style="{ width: successWidth }"
            />

            <div
                class="progress-bar bg-dark"
                :style="{ width: darkWidth }"
            />

            <div
                class="progress-bar bg-danger"
                :style="{ width: dangerWidth }"
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
            dangerWidth: vue => vue.spent ? (vue.spent - vue.estimated) / vue.spent * 100 + '%' : 0,
            darkWidth: vue => {
                if (vue.completion === 100 && vue.spent <= vue.estimated) {
                    return 0;
                }
                if (vue.spent <= vue.estimated) {
                    return vue.spent / vue.estimated * 100 + '%';
                }
                return vue.estimated / vue.spent * 100 + '%';
            },
            successWidth: vue => {
                if (vue.completion < 100) {
                    return 0;
                }
                if (vue.spent > vue.estimated) {
                    return 0;
                }
                return vue.spent / vue.estimated * 100 + '%';
            },
        },
    };

</script>
5 4