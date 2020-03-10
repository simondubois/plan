<template>

    <div class="d-flex align-items-center">
        <div
            v-for="task in tasks"
            :key="task.id"
            class="position-sticky"
        >
            <task-tree :task="task" />
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

    .align-items-center {
        min-height: 100%;
    }

    .position-sticky {
        top: 0px;
        bottom: 0px;
    }

</style>
