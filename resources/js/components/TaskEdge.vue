<template>

    <svg
        :viewBox="viewBox"
        xmlns="http://www.w3.org/2000/svg"
    >
        <g
            v-for="path in paths"
            :key="path"
        >
            <path :d="path" />
        </g>
    </svg>

</template>



<script>

    export default {
        props: {
            childElements: {
                type: Array,
                required: true,
            },
            horizontal: {
                type: Boolean,
                default: false,
            },
            parentElement: {
                type: HTMLDivElement,
                required: true,
            },
        },
        data: () => ({
            height: 0,
            paths: [],
            width: 0,
        }),
        computed: {
            viewBox: vue => vue.horizontal ? '0 0 100 ' + vue.height : '0 0 ' + vue.width + ' 100',
        },
        mounted() {
            this.updatePaths();
            this.updateSize();
            window.addEventListener('resize', this.updatePaths)
            window.addEventListener('resize', this.updateSize)
            this.$el.closest('.overflow-auto').addEventListener('scroll', this.updatePaths)
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.updatePaths);
            window.removeEventListener('resize', this.updateSize);
        },
        methods: {
            updatePaths() {
                if (this.horizontal) {
                    this.parentPosition = this.parentElement.offsetTop - this.$el.parentElement.offsetTop + this.parentElement.offsetHeight / 2;
                    this.paths = this.childElements
                        .map(el => el.offsetTop - el.parentElement.parentElement.parentElement.offsetTop + el.offsetHeight / 2)
                        .map(childPosition => 'm0,' + this.parentPosition + ' C 100,' + this.parentPosition + ' 50,'+ childPosition + ' 100,' + childPosition);
                } else {
                    this.parentPosition = this.parentElement.offsetLeft - this.$el.parentElement.offsetLeft + this.parentElement.offsetWidth / 2;
                    this.paths = this.childElements
                        .map(el => el.offsetLeft - el.parentElement.parentElement.parentElement.offsetLeft + el.offsetWidth / 2)
                        .map(childPosition => 'm' + this.parentPosition + ',0 C ' + this.parentPosition + ',100 '+ childPosition + ',50 ' + childPosition + ',100');
                }
            },
            updateSize() {
                if (this.horizontal) {
                    this.height = this.$el.parentElement.offsetHeight;
                } else {
                    this.width = this.$el.parentElement.offsetWidth;
                }
            },
        },
    };

</script>



<style scoped>

    path {
        stroke: #8E8C84;
        fill: none;
    }

</style>
