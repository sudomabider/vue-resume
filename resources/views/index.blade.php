<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Veo Chen | Web Developer</title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>

<body>
<div id="root"></div>

<footer class="ubuntu-mono">
    <div class="container text-xs-center">
        <div class="copyright">
            ©COPYRIGHT {{ \Carbon\Carbon::today()->year }} veoveo.me
        </div>
        <div style="text-transform: uppercase">
            <a href="https://github.com/sudomabider" target="_blank">
                <i class="fa fa-github"></i> sudomabider
            </a>
        </div>
    </div>
</footer>

<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>