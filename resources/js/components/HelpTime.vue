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
                    {{ $t('help.time.notEstimated') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="0"
                        :estimated="0"
                        :spent="0"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="0"
                        :estimated="0"
                        :spent="0"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.unspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="0"
                        :estimated="60"
                        :spent="0"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="0"
                        :estimated="60"
                        :spent="0"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.uncompletedUnderspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="50"
                        :estimated="60"
                        :spent="30"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="50"
                        :estimated="60"
                        :spent="30"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.completedUnderspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="100"
                        :estimated="60"
                        :spent="30"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="100"
                        :estimated="60"
                        :spent="30"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.uncompletedFullyspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="50"
                        :estimated="60"
                        :spent="60"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="50"
                        :estimated="60"
                        :spent="60"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.completedFullyspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="100"
                        :estimated="60"
                        :spent="60"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="100"
                        :estimated="60"
                        :spent="60"
                    />
                </td>

            </tr>

            <tr>

                <td>
                    {{ $t('help.time.overspent') }}
                </td>

                <td class="text-center">
                    <bs-progress-time
                        :completion="50"
                        :estimated="60"
                        :spent="90"
                    />
                </td>

                <td class="text-center">
                    <bs-badge-time
                        :completion="50"
                        :estimated="60"
                        :spent="90"
                    />
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
