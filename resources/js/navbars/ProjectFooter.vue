<template>

    <bs-navbar>

        <li
            slot="right"
            class="nav-item"
        >
            <a
                class="nav-link"
                href="#"
                @click.prevent="openHelp"
            >
                <fontawesome-icon icon="help" />
                <span class="d-none d-md-inline">
                    {{ $t('help.modal.title') }}
                </span>
            </a>
        </li>

        <help-modal
            slot="outside"
            :is-open="isHelpOpen"
            @modal:close="closeHelp"
        />

    </bs-navbar>

</template>



<script>

    export default {
        data: () => ({
            isHelpOpen: false,
        }),
        methods: {
            closeHelp() {
                this.isHelpOpen = false;
            },
            openHelp() {
                this.isHelpOpen = true;
            },
        },
    };

</script>
