<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name','LAPP')}}</title> <!-- app.name=APPNAME mudada em .env | o 2 parametro é se caso não achar o 1º -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- vai public>app.css -->
</head>
<body>
    
    @include('inc.navbar')<!-- incluindo o que está na pasta inc.navbar -->
        
    <div class="container"><!-- bootstrap class -->
        @include('inc.messages')
        @yield('content')
    </div>
        

    <!-- Scripts -->
    <!-- script para o ckeditor -->
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' ); 
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>