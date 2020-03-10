<template>

    <div :class="{ container: parentId === null }">
        <ul class="list-group list-group-flush">
            <task-item
                v-for="task in tasks"
                :key="task.id"
                :task="task"
            />
        </ul>
    </div>

</template>



<script>

    export default {
        props: {
            parentId: {
                type: Number,
                default: null,
            },
        },
        computed: {
            tasks: vue => vue.$store.getters['task/children'](vue.parentId),
        },
    };

</script>
