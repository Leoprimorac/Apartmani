<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="google-site-verification" content="M8VLj3iFlTx9HSgce_blhOuvX6tNbNQgML9RzxiIeaA" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}" >
        <title>Villa Lara</title>
        <meta name ="description" content ="Najbolje mjesto za odmor- Villa Lara">
        <meta name ="keywords" content ="Villa Lara, Villa, Promajna, Miličević, Milicevic, Apartmani, Apartmani Promajna, Apartmani Makarska,
        Makarska, Split, Drvenik, Makarska rivijera, rivijera, rezervacija apartmana, apartmani izdavanje, booking " >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="distribution" content="global"/>
        <?php header('Access-Control-Allow-Origin: *'); ?>
        <base href="/" />
    </head>
    <body>
        <div id="app" class="d-flex flex-column">


                    <navbar></navbar>

                <router-view></router-view>



        </div>


    <script src="js/app.js"></script>
    </body>
</html>
