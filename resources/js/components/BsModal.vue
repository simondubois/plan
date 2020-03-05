

<template>

    <transition
        mode="out-in"
        name="fade"
        appear
    >
        <div
            v-if="isOpen"
            class="modal d-block bg-dark"
            @click.self="triggerClose"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            <fontawesome-icon :icon="icon" />
                            {{ title }}
                        </h5>

                        <button
                            class="btn btn-link"
                            type="button"
                            @click.prevent="triggerClose"
                        >
                            <fontawesome-icon icon="close" />
                        </button>

                    </div>

                    <div class="modal-body">
                        <slot />
                    </div>

                    <div
                        v-if="showFooter"
                        class="modal-footer d-flex justify-content-between"
                    >

                        <div>
                            <slot name="footer-left" />
                        </div>

                        <div>

                            <button
                                class="btn btn-link"
                                type="button"
                                @click.prevent="triggerClose"
                            >
                                <fontawesome-icon icon="close" />
                                {{ $t('actions.cancel') }}
                            </button>

                            <slot name="footer-right" />

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </transition>

</template>



<script>

    export default {
        props: {
            icon: {
                type: String,
                required: true,
            },
            isOpen: {
                type: Boolean,
                default: true,
            },
            title: {
                type: String,
                required: true,
            },
        },
        computed: {
            showFooter: vue => vue.$slots['footer-left'] || vue.$slots['footer-right'],
        },
        watch: {
            isOpen: {
                handler(isOpen) {
                    if (isOpen) {
                        this.open();
                    } else {
                        this.close();
                    }
                },
                immediate: true,
            },
        },
        beforeDestroy() {
            this.close();
        },
        methods: {
            open() {
                document.body.classList.add('modal-open');
                this.$nextTick(() => {
                    const autofocus = this.$el.querySelector('[autofocus]');
                    if (autofocus) {
                        autofocus.focus();
                    }
                });
            },
            close() {
                document.body.classList.remove('modal-open');
            },
            triggerClose() {
                this.$emit('modal:close');
            },
        },
    };

</script>
