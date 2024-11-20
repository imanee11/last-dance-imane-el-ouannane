<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tasker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#101010]">
            <div class="w-[80vw] h-[90vh]  px-6 py-4 bg-[#171717] shadow-md shadow-black/40 overflow-hidden sm:rounded-lg flex items-center justify-center gap-4">
                <div class="w-[50vw] h-[85vh] relative">
                    <img class="w-[100%] h-[100%] object-cover rounded-lg" src="{{ asset('images/registerImg.jpg') }}" alt="logo Image" >
                    <div class="absolute top-5 left-5">
                        <img class="w-[6vw]" src="{{ asset('images/newlogo.png') }}" alt="logo Image" >
                    </div>
                </div>
                <div class="w-[50vw] px-[3vw] ">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </body>
</html>
