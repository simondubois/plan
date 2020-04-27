<template>

    <div
        :class="[{ 'd-flex': horizontal }, horizontal ? 'my-2' : 'mx-2']"
        :style="{ 'flex-grow': space }"
    >

        <div
            :class="{ 'flex-column': horizontal }"
            class="d-flex justify-content-center"
        >
            <task-node
                :id="'task-node-' + task.id"
                :task="task"
                class="position-sticky"
            />
        </div>

        <task-edge
            v-if="childNodes.length"
            :key="edgeKey"
            :child-elements="childNodes"
            :horizontal="horizontal"
            :parent-element="parentNode"
        />

        <component
            :is="draggable ? 'vue-draggable' : 'div'"
            v-if="children.length"
            :class="{ 'flex-column': horizontal }"
            :group="'task-tree-' + task.id"
            :list="children"
            animation="500"
            class="d-flex"
            @update="updateHandler"
        >
            <task-tree
                v-for="child in children"
                :key="child.id"
                :class="{ grabbable: draggable }"
                :horizontal="horizontal"
                :task="child"
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
            horizontal: {
                type: Boolean,
                default: false,
            },
            task: {
                type: Object,
                required: true,
            },
        },
        data: () => ({
            childNodes: [],
            edgeKey: '',
            parentNode: null,
        }),
        computed: {
            children: vue => vue.$store.getters['task/children'](vue.task.id),
            draggable: vue => vue.children.length > 1,
            space: vue => vue.$store.getters['task/leaves'](vue.task.id).length || 1,
            updateHandler: vue => vue.draggable ? vue.submit : () => {},
        },
        watch: {
            children: {
                handler() {
                    this.$nextTick(this.watchDom);
                },
            },
        },
        mounted() {
            this.watchDom();
        },
        methods: {
            submit(event) {
                const task = this.children[event.newDraggableIndex];
                require('axios')
                    .put('api/tasks/' + task.id, { ...task, position: event.newDraggableIndex + 1 })
                    .then(() => this.$emit('task:updated'));
            },
            watchDom() {
                this.parentNode = this.$el.querySelector('#task-node-' + this.task.id);
                this.childNodes = this.children.map(task => this.$el.querySelector('#task-node-' + task.id));
                this.edgeKey = this.children.map(task => this.$store.getters['task/leaves'](task.id).length || 1).toString();
            },
        },
    };

</script>



<style lang="scss" scoped>

    .position-sticky {
        top: 0px;
        left: 8px;
        bottom: 0px;
        right: 8px;
    }

</style>
