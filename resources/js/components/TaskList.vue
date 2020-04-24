<template>

    <div :class="{ container: parentId === null }">
        <component
            :is="draggable ? 'vue-draggable' : 'div'"
            v-if="tasks.length"
            :group="'task-list-' + parentId"
            :list="tasks"
            animation="500"
            class="list-group list-group-flush"
            tag="ul"
            @update="updateHandler"
        >
            <task-item
                v-for="task in tasks"
                :key="task.id"
                :class="{ grabbable: draggable }"
                :task="task"
                @task:updated="$emit('task:updated')"
            />
        </component>
    </div>

</template>



<script>

    export default {
        components: {
            'vue-draggable': require('vuedraggable'),
        },
        props: {
            parentId: {
                type: Number,
                default: null,
            },
        },
        computed: {
            draggable: vue => vue.tasks.length > 1,
            tasks: vue => vue.$store.getters['task/children'](vue.parentId),
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
