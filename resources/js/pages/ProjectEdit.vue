
<template>

    <form
        autocomplete="off"
        @submit.prevent="submit"
    >
        <bs-modal
            :title="$t('project.edit.title')"
            icon="edit"
            @modal:close="close"
        >

            <div class="form-group">

                <label for="project-edit-name">
                    {{ $t('project.attributes.name') }}
                </label>

                <input
                    id="project-edit-name"
                    v-model="project.name"
                    :class="formControlClass('name')"
                    class="form-control"
                    type="text"
                    autofocus
                    required
                >

                <div
                    v-for="(error, index) in errors.name"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>

            </div>

            <project-delete
                slot="footer-left"
                :project-id="projectId"
                @project:deleted="$emit('project:deleted') ; close()"
            />

            <button
                slot="footer-right"
                class="btn btn-primary"
                type="submit"
            >
                <fontawesome-icon icon="save" />
                {{ $t('actions.save') }}
            </button>

        </bs-modal>
    </form>

</template>



<script>

    export default {
        props: {
            projectId: {
                type: [Number, String],
                required: true,
            },
        },
        data: () => ({
            project: {},
            errors: {},
        }),
        watch: {
            projectId: {
                handler: 'fetchProject',
                immediate: true,
            },
        },
        methods: {
            close() {
                this.$router.push({
                    name: 'project-index',
                });
            },
            fetchProject() {
                require('axios')
                    .get('api/projects/' + this.projectId)
                    .then(response => this.project = response.data.data);
            },
            submit() {
                require('axios')
                    .put('api/projects/' + this.projectId, this.project)
                    .then(
                        () => {
                            this.$emit('project:updated');
                            this.close();
                        },
                        response => this.errors = response.response.data.errors
                    );
            },
        },
    };

</script>
