
<template>

    <form
        autocomplete="off"
        @submit.prevent="submit"
    >
        <bs-modal
            :title="$t('project.create.title')"
            icon="create"
            @modal:close="close"
        >

            <div class="form-group">

                <label for="project-new-name">
                    {{ $t('project.attributes.name') }}
                </label>

                <input
                    id="project-new-name"
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
        data: () => ({
            project: {
                name: '',
            },
            errors: {},
        }),
        methods: {
            close() {
                this.$router.push({
                    name: 'project-index',
                });
            },
            submit() {
                require('axios')
                    .post('api/projects', this.project)
                    .then(
                        () => {
                            this.$emit('project:stored');
                            this.close();
                        },
                        response => this.errors = response.response.data.errors
                    );
            },
        },
    };

</script>
