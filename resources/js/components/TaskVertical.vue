<template>

    <component
        :is="draggable ? 'vue-draggable' : 'div'"
        :list="tasks"
        animation="500"
        class="d-flex align-items-center"
        group="task-tree-null"
        @update="updateHandler"
    >
        <div
            v-for="task in tasks"
            :key="task.id"
            :class="{ grabbable: draggable }"
            class="position-sticky"
        >
            <task-tree
                :task="task"
                @task:updated="$emit('task:updated')"
            />
        </div>
    </component>

</template>



<script>

    export default {
        components: {
            'vue-draggable': require('vuedraggable'),
        },
        computed: {
            draggable: vue => vue.tasks.length > 1,
            tasks: vue => vue.$store.getters['task/children'](null),
            updateHandler: vue => vue.draggable ? vue.submit : () => {},
        },
        methods: {
            submit(event) {
                const task = this.tasks[event.newDraggableIndex];
                require('axios')
                    .put('api/tasks/' + task.id, { ...task, position: event.newDraggableIndex + 1 })
                    .then(() => this.$emit('task:updated'));
            },
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
