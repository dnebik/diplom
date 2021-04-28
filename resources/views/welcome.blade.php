<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document Server</title>

    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>


<div id="app" :class="{modal__open: modal_opened}">
    <top> </top>
    <div class="container-wrapper">
        <div class="container">
            <loading v-if="!loaded" class="main-loading"></loading>
            <router-view></router-view>
        </div>
    </div>
</div>


{{--<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>--}}
<script src="{{ asset('js/vendor/pdf.js/pdf.js') }}"></script>
{{--<script src="{{ asset('js/vendor/pdf.js/pdf.worker.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
