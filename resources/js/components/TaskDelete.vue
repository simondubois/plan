
<template>

    <button
        v-if="confirming"
        class="btn btn-danger"
        type="button"
        @click="submit"
    >
        <fontawesome-icon icon="valid" />
        {{ $t('actions.confirm') }}
    </button>

    <button
        v-else
        class="btn btn-warning"
        type="button"
        @click="confirm"
    >
        <fontawesome-icon icon="delete" />
        {{ $t('actions.delete') }}
    </button>

</template>



<script>

    export default {
        props: {
            taskId: {
                type: [Number, String],
                required: true,
            },
        },
        data: () => ({
            confirming: false,
        }),
        methods: {
            confirm() {
                this.confirming = true;
            },
            submit() {
                require('axios')
                    .delete('api/tasks/' + this.taskId)
                    .then(() => this.$emit('task:deleted'));
            },
        },
    };

</script>
