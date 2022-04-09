<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    </head>
    <body class="antialiased h-full">
        <div id="app" class="flex flex-col min-h-full bg-slate-200"></div>
        
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
