<template>

    <bs-modal
        :is-open="isOpen"
        :title="$t('help.modal.title')"
        icon="help"
        @modal:close="close"
    >

        <ul class="nav nav-tabs mb-3">

            <li class="nav-item">
                <a
                    :class="{ active: content === 'completion' }"
                    class="nav-link"
                    href="#"
                    @click.prevent="content = 'completion'"
                >
                    <fontawesome-icon icon="completion" />
                    {{ $t('help.completion.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a
                    :class="{ active: content === 'time' }"
                    class="nav-link"
                    href="#"
                    @click.prevent="content = 'time'"
                >
                    <fontawesome-icon icon="time" />
                    {{ $t('help.time.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a
                    :class="{ active: content === 'date' }"
                    class="nav-link"
                    href="#"
                    @click.prevent="content = 'date'"
                >
                    <fontawesome-icon icon="date" />
                    {{ $t('help.date.title') }}
                </a>
            </li>

        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active">
                <component :is="contentComponent" />
            </div>
        </div>

    </bs-modal>

</template>



<script>

    export default {
        props: {
            isOpen: {
                type: Boolean,
                required: true,
            },
        },
        data: () => ({
            content: 'completion',
        }),
        computed: {
            contentComponent: vue => 'help-' + vue.content,
        },
        methods: {
            close() {
                this.$emit('modal:close');
            },
        },
    };

</script>
