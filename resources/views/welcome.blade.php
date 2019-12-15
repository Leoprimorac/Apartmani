<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}" >
        <title>Villa Promajna</title>
        <meta name ="description" content ="Villa Promajna, kuća je sa 8 apartmana, smještena u starom dijelu Promajne." />
        <meta name ="keywords" content ="Villa Promajna, Villa, Promajna, Miličević,Milicević, Apartmani, Apartmani Promajna, Apartmani Makarska
        Makarska, Split, Drvenik, Makarska rivijera, rivijera, rezervacija apartmana, apartmani izdavanje " />
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
