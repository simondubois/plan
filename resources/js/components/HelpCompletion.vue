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
                    {{ $t('help.completion.unstarted') }}
                </td>

                <td class="text-center">
                    <bs-progress-completion :completion="0" />
                </td>

                <td class="text-center">
                    <bs-badge-completion :completion="0" />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.completion.uncompleted') }}
                </td>

                <td class="text-center">
                    <bs-progress-completion :completion="50" />
                </td>

                <td class="text-center">
                    <bs-badge-completion :completion="50" />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.completion.completed') }}
                </td>

                <td class="text-center">
                    <bs-progress-completion :completion="100" />
                </td>

                <td class="text-center">
                    <bs-badge-completion :completion="100" />
                </td>

            </tr>

        </tbody>

    </table>

</template>



<script>

    export default {
        //
    };

</script>
