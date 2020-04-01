export default {

    actions: {
        cancel: 'Cancel',
        confirm: 'Confirm',
        delete: 'Delete',
        save: 'Save',
    },

    help: {
        completion: {
            completed: 'Finished',
            title: 'Completion',
            uncompleted: 'Hald done',
            unstarted: 'Not started',
        },
        date: {
            complete: 'Finished',
            future: 'Future',
            past: 'Past',
            present: 'Current',
            title: 'Time frame',
        },
        modal: {
            branchTask: 'Project / Metatask',
            leafTask: 'Single task',
            title: 'Legend',
        },
        time: {
            completedFullyspent: 'Fully spent, finished',
            completedUnderspent: 'Underspent, finished',
            notEstimated: 'Not estimated',
            overspent: 'Overspent',
            title: 'Budget',
            uncompletedFullyspent: 'Fully spent, unfinished',
            uncompletedUnderspent: 'Underspent, unfinished',
            unspent: 'Unspent',
        },
    },

    project: {
        attributes: {
            name: 'Name',
        },
        create: {
            title: 'New project',
        },
        edit: {
            title: 'Edit',
        },
        index: {
            empty: 'No project',
            title: 'My projects',
        },
    },

    task: {
        attributes: {
            completion: 'Completion',
            date: 'Planned at',
            end: 'Ending date',
            estimated_time: 'Estimated duration',
            name: 'Title',
            noParent: 'No parent',
            parent_id: 'Parent task',
            spent_time: 'Spent duration',
            start: 'Starting date',
        },
        create: {
            title: 'New task',
            titleChild: 'Subtask',
            titleRoot: 'Root task',
        },
        edit: {
            title: 'Edit',
        },
        index: {
            empty: 'No task',
            title: 'Tasks',
        },
    },

    units: {
        days: 'd.',
        minutes: 'minutes',
    },

};
