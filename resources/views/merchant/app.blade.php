<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- aditional links --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/front.css')}}" class="style">
    

    @stack('styles')

</head>


<body dir="rtl">
    <div id="app">

        @include('merchant.partials.navbar')
 

        <main class="py-4">
            @yield('content')
        </main>


 

    </div>


    <footer class="bg-light text-center text-lg-start footer fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-2 text-dark" style="background-color: rgba(0, 0, 0, 0.2);">
          copyleft:
          <a class="text-dark" href="https://instagram.com/yacinpi/">@Yacin Pishvaz</a>
        </div>
        <!-- Copyright -->
      </footer>


    @stack('scripts')

</body>

</html>
