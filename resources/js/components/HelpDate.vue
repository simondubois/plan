<template>

    <table class="table table-borderless mb-0">

        <thead>
            <tr>

                <th />

                <th class="text-center">
                    {{ $t('help.modal.branchTask') }}
                </th>

                <th class="text-center">
                    {{ $t('help.modal.leafTask') }}
                </th>

            </tr>
        </thead>

        <tbody>

            <tr>

                <td>
                    {{ $t('help.date.complete') }}
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="100"
                        :end="present[present.length - 1]"
                        :start="present[0]"
                        class="mb-2"
                    />
                    <bs-progress-date
                        :completion="100"
                        :dates="present"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="100"
                        :end="today"
                        :start="today"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.date.future') }}
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="0"
                        :end="future[future.length - 1]"
                        :start="future[0]"
                        class="mb-2"
                    />
                    <bs-progress-date
                        :completion="0"
                        :dates="future"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="0"
                        :end="future[future.length - 1]"
                        :start="future[future.length - 1]"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.date.present') }}
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="0"
                        :end="present[present.length - 1]"
                        :start="present[0]"
                        class="mb-2"
                    />
                    <bs-progress-date
                        :completion="0"
                        :dates="present"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="0"
                        :end="today"
                        :start="today"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.date.past') }}
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="50"
                        :end="past[past.length - 1]"
                        :start="past[0]"
                        class="mb-2"
                    />
                    <bs-progress-date
                        :completion="50"
                        :dates="past"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-date
                        :completion="50"
                        :end="past[past.length - 1]"
                        :start="past[past.length - 1]"
                    />
                </td>

            </tr>

        </tbody>

    </table>

</template>



<script>

    export default {
        computed: {
            future: vue => [
                vue.today.add(3, 'day'),
                vue.today.add(4, 'days'),
                vue.today.add(5, 'days'),
            ],
            past: vue => [
                vue.today.subtract(5, 'days'),
                vue.today.subtract(4, 'days'),
                vue.today.subtract(3, 'day'),
            ],
            present: vue => [
                vue.today.subtract(2, 'days'),
                vue.today.subtract(1, 'day'),
                vue.today,
                vue.today.add(1, 'day'),
                vue.today.add(2, 'days'),
            ],
        },
    };

</script>
