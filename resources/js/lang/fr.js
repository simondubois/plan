export default {

    actions: {
        cancel: 'Annuler',
        confirm: 'Confirmer',
        delete: 'Supprimer',
        save: 'Enregistrer',
    },

    help: {
        completion: {
            completed: 'Achevé',
            title: 'Achèvement',
            uncompleted: 'À moité achevé',
            unstarted: 'Non commencé',
        },
        date: {
            complete: 'Achevé',
            future: 'Futur',
            past: 'Passé',
            present: 'Actuel',
            title: 'Période',
        },
        modal: {
            branchTask: 'Projet / Méta-tâche',
            leafTask: 'Tâche simple',
            title: 'Légende',
        },
        time: {
            completedFullyspent: 'Dépense complète (achevé)',
            completedUnderspent: 'Dépense partielle (achevé)',
            notEstimated: 'Non estimé',
            overspent: 'Dépassement',
            title: 'Budget',
            uncompletedFullyspent: 'Dépense complète (inachevé)',
            uncompletedUnderspent: 'Dépense partielle (inachevé)',
            unspent: 'Non consommé',
        },
    },

    project: {
        attributes: {
            name: 'Nom',
        },
        create: {
            title: 'Nouveau projet',
        },
        edit: {
            title: 'Modifier',
        },
        index: {
            empty: 'Aucun projet',
            title: 'Mes projets',
        },
    },

    task: {
        attributes: {
            completion: 'Complétion',
            date: 'Plannifié le',
            end: 'Date de fin',
            estimated_time: 'Durée estimée',
            name: 'Intitulé',
            noParent: 'Pas de parent',
            parent_id: 'Tâche parente',
            spent_time: 'Durée passée',
            start: 'Date de début',
        },
        create: {
            title: 'Nouvelle tâche',
            titleChild: 'Sous-tâche',
            titleRoot: 'Tâche principale',
        },
        edit: {
            title: 'Modifier',
        },
        index: {
            empty: 'Aucune tâche',
            title: 'Tâches',
        },
    },

    units: {
        days: 'j.',
        minutes: 'minutes',
    },

};
