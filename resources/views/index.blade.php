<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Currency Converter</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <main id="app">
            <div class="container d-flex flex-column min-vh-100">
                <div class="row flex-grow-1 justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <currency-converter></currecny-converter>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
