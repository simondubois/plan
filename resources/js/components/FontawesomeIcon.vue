<template>

    <i :class="classes" />

</template>



<script>

    const iconClasses = {
        // actions
        close: 'fa-times',
        create: 'fa-plus',
        delete: 'fa-trash',
        edit: 'fa-pen',
        help: 'fa-question-circle',
        next: 'fa-chevron-right',
        previous: 'fa-chevron-left',
        save: 'fa-save',
        sync: 'fa-sync',
        valid: 'fa-check',
        // entities
        projects: 'fa-th',
        'task-calendar': 'fa-calendar',
        'task-horizontal': 'fa-sitemap fa-rotate-270',
        'task-list': 'fa-tasks',
        'task-vertical': 'fa-sitemap',
        tasks: 'fa-project-diagram',
        completion: 'fa-running',
        date: 'fa-calendar-alt',
        time: 'fa-stopwatch',
        today: 'fa-star',
    };
    export default {
        props: {
            icon: {
                type: String,
                required: true,
                validator: icon => iconClasses[icon] !== undefined,
            },
            spin: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            classes: vue => ({
                fa: true,
                'fa-fw': true,
                'fa-sm': true,
                'fa-spin': vue.spin,
                [vue.iconClass]: true,
            }),
            iconClass: vue => iconClasses[vue.icon],
        },
    };

</script>



<style scoped>

    .fa-rotate-90.fa-flip-horizontal {
        transform: rotate(90deg) scaleY(-1);
    }

</style>
