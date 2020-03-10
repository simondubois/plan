const state = {
    all: [],
};

const getters = {
    all: state => state.all,
    children: state => parentId => state.all.filter(task => task.parent_id === parentId),
    find: state => id => state.all.find(task => task.id === id),
    leaves: (state, getters) => parentId =>
        getters.children(parentId).reduce(
            (leaves, child) => leaves.concat(getters.children(child.id).length ? getters.leaves(child.id) : [child]), []
        ),
};

const mutations = {
    all: (state, all) => state.all = all.map(task => ({
        ...task,
        end: task.end ? require('dayjs')(task.end).startOf('day') : null,
        start: task.start ? require('dayjs')(task.start).startOf('day') : null,
    })),
};

const actions = {
    clear: ({ commit }) => commit('all', []),
    fetch: ({ commit }, projectId) =>
        require('axios')
            .get('api/tasks?project_id=' + projectId)
            .then(response => commit('all', response.data.data)),
};

export {
    state,
    getters,
    mutations,
    actions,
};
