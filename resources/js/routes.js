export default [
    {
        path: '/projects',
        name: 'project-index',
        components: {
            footer: require('./navbars/ProjectFooter.vue').default,
            header: require('./navbars/ProjectHeader.vue').default,
            layout: require('./pages/ProjectIndex.vue').default,
        },
        children: [
            {
                path: 'create',
                name: 'project-create',
                component: require('./pages/ProjectCreate.vue').default,
            },
            {
                path: 'edit/:projectId',
                name: 'project-edit',
                component: require('./pages/ProjectEdit.vue').default,
            },
        ],
    },
    {
        path: '*',
        redirect: '/projects',
    },
];
