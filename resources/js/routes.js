export default [
    {
        path: '/projects',
        name: 'project-index',
        components: {
            footer: require('./navbars/ProjectFooter.vue').default,
            header: require('./navbars/ProjectHeader.vue').default,
            layout: require('./pages/ProjectIndex.vue').default,
        },
    },
    {
        path: '*',
        redirect: '/projects',
    },
];