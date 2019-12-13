<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}" >
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <?php header('Access-Control-Allow-Origin: *'); ?>
        <base href="" />
    </head>
    <body>
        <div id="app" class="d-flex flex-column">


                    <navbar></navbar>

                <router-view></router-view>



        </div>


    <script src="js/app.js"></script>
    </body>
</html>
