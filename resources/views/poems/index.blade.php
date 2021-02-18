<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Laravel</title>

      

    </head>
    <body>
        <div class="page-wrap" id="example">
       
            <example-component2></example-component2>
                 <section>
               </section>
           </div>



        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
