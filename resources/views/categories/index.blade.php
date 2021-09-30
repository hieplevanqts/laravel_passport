<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.nestable.min.css') }}">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-body">
                               @include('categories.category_table', ['cateories', $categories])
                        </div>
                    </div>
                </div> --}}


                {{-- <div class="col-md-6">
                    <div class="card mt-2">
                        <div class="card-body">
                               @include('categories.select_box.category_select', ['cateories', $categories])
                        </div>
                    </div>
                </div> --}}

                <div class="dd" id="dd">
                    <ol class="dd-list">
                        @foreach ($categories as $item)
                            @include('categories.select_box.list_item', ['item'=>$item])
                        @endforeach
                    </ol>
                </div>

                <textarea id="dataOutput" class="form-control"></textarea>


            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/jquery.nestable.min.js') }}"></script>
        <script>
            let Output = $('#dataOutput')
            let dd = $('#dd')

            dd.nestable({  }).on('change', function(){

            })
            var dataOutput = dd.nestable('serialize');
            console.log(dataOutput);
            Output.val(JSON.stringify(dataOutput))
        </script>
    </body>
</html>
