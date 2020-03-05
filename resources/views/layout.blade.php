<!doctype html>

<html lang="{{ env('APP_LOCALE') }}" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#FFF">
        <link rel="icon" href="logo-large.png" />
        <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <title>{{ env('APP_NAME') }}</title>
    </head>

    <body class="bg-light h-100">

        <div id="app" class="d-flex flex-column h-100">

            <router-view name="header" ref="header" v-bind="[$route.params, $route.query]"></router-view>

            <transition mode="out-in" name="fade" appear>
                <router-view class="flex-grow-1 overflow-auto py-4" name="layout" v-bind="[$route.params, $route.query]"></router-view>
            </transition>

            <router-view name="footer" v-bind="[$route.params, $route.query]"></router-view>

        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

    </body>

</html>
