<template>

    <div class="d-flex flex-column align-items-center">
        <div
            v-for="task in tasks"
            :key="task.id"
            class="position-sticky"
        >
            <task-tree
                :task="task"
                horizontal
            />
        </div>
    </div>

</template>



<script>

    export default {
        computed: {
            tasks: vue => vue.$store.getters['task/children'](null),
        },
    };

</script>



<style scoped>

    .d-flex /deep/ svg {
        width: 100px;
    }

    .align-items-center {
        min-width: 100%;
    }

    .position-sticky {
        right: 0px;
        left: 0px;
    }

</style>
