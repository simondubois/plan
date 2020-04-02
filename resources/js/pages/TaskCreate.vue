
<template>

    <form
        autocomplete="off"
        @submit.prevent="submit"
    >
        <bs-modal
            :title="$t('task.create.title')"
            icon="create"
            @modal:close="close"
        >

            <div class="form-group">

                <label for="task-create-parent_id">
                    {{ $t('task.attributes.parent_id') }}
                </label>

                <select
                    id="task-create-parent_id"
                    v-model="task.parent_id"
                    :class="formControlClass('parent_id')"
                    class="form-control"
                >

                    <option :value="null">
                        {{ $t('task.attributes.noParent') }}
                    </option>

                    <option
                        v-for="parent in parents"
                        :key="parent.id"
                        :value="parent.id"
                    >
                        {{ parent.code }}. {{ parent.name }}
                    </option>

                </select>

                <div
                    v-for="(error, index) in errors.parent_id"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>

            </div>

            <div class="form-group">

                <label for="task-create-name">
                    {{ $t('task.attributes.name') }}
                </label>

                <input
                    id="task-create-name"
                    v-model="task.name"
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

            <div class="row">

                <div class="col-sm">
                    <div class="form-group">

                        <label for="task-create-estimated_time">
                            {{ $t('task.attributes.estimated_time') }}
                        </label>

                        <div
                            :class="formControlClass('estimated_time')"
                            class="input-group"
                        >

                            <input
                                id="task-create-estimated_time"
                                v-model="task.estimated_time"
                                :class="formControlClass('estimated_time')"
                                class="form-control text-right"
                                max="16777215"
                                min="0"
                                step="15"
                                type="number"
                            >

                            <div class="input-group-append">
                                <span class="input-group-text">
                                    {{ $t('units.minutes') }}
                                </span>
                            </div>

                        </div>

                        <div
                            v-for="(error, index) in errors.estimated_time"
                            :key="index"
                            class="invalid-feedback"
                        >
                            {{ error }}
                        </div>

                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">

                        <label for="task-create-spent_time">
                            {{ $t('task.attributes.spent_time') }}
                        </label>

                        <div
                            :class="formControlClass('spent_time')"
                            class="input-group"
                        >

                            <input
                                id="task-create-spent_time"
                                v-model="task.spent_time"
                                :class="formControlClass('spent_time')"
                                class="form-control text-right"
                                max="16777215"
                                min="0"
                                step="15"
                                type="number"
                            >

                            <div class="input-group-append">
                                <span class="input-group-text">
                                    {{ $t('units.minutes') }}
                                </span>
                            </div>

                        </div>

                        <div
                            v-for="(error, index) in errors.spent_time"
                            :key="index"
                            class="invalid-feedback"
                        >
                            {{ error }}
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group">

                <label for="task-create-name">
                    {{ $t('task.attributes.date') }}
                </label>

                <input
                    id="task-create-date"
                    v-model="task.date"
                    :class="formControlClass('date')"
                    class="form-control"
                    type="date"
                >

                <div
                    v-for="(error, index) in errors.date"
                    :key="index"
                    class="invalid-feedback"
                >
                    {{ error }}
                </div>

            </div>

            <div class="form-group">

                <label for="task-create-completion">
                    {{ $t('task.attributes.completion') }}
                </label>

                <datalist
                    id="task-create-completion-values"
                    class="d-flex justify-content-between text-center small text-muted"
                >
                    <option
                        value="0"
                        label="0%"
                    />
                    <option value="10" />
                    <option value="20" />
                    <option value="30" />
                    <option value="40" />
                    <option
                        value="50"
                        label="50%"
                    />
                    <option value="60" />
                    <option value="70" />
                    <option value="80" />
                    <option value="90" />
                    <option
                        value="100"
                        label="100%"
                    />
                </datalist>

                <input
                    id="task-create-completion"
                    v-model="task.completion"
                    :class="formControlClass('completion')"
                    class="form-control"
                    list="task-create-completion-values"
                    step="5"
                    type="range"
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
        props: {
            parentId: {
                type: [Number, String],
                default: null,
            },
            projectId: {
                type: [Number, String],
                required: true,
            },
        },
        data: () => ({
            task: {
                completion: 0,
                estimated_time: 0,
                spent_time: 0,
            },
            errors: {},
        }),
        computed: {
            parents: vue => vue.$store.getters['task/all'],
        },
        watch: {
            parentId: {
                handler() {
                    this.task.parent_id = this.parentId;
                },
                immediate: true,
            },
            projectId: {
                handler() {
                    this.task.project_id = this.projectId;
                },
                immediate: true,
            },
        },
        methods: {
            close() {
                this.$router.push({
                    name: 'task-index',
                    query: this.$route.query,
                });
            },
            submit() {
                require('axios')
                    .post('api/tasks', this.task)
                    .then(
                        () => this.$emit('task:stored') && this.close(),
                        response => this.errors = response.response.data.errors
                    );
            },
        },
    };

</script>



<style scoped>

    datalist option {
        flex-grow: 1;
        flex-basis: 0;
    }

</style>
