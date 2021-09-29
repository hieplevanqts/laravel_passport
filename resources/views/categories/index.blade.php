<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-body">
                               @include('categories.category_table', ['cateories', $categories])
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card mt-2">
                        <div class="card-body">
                               @include('categories.select_box.category_select', ['cateories', $categories])
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </body>
</html>
