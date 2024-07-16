<!DOCTYPE html>
<html class="dark" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="{{ csrf_token() }}" name="csrf-token">

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Vite assets -->
        @vite(["resources/css/app.css", "resources/js/app.js"])

        <!-- Wireui -->
        <wireui:scripts />
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div
            class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 dark:bg-gray-900 sm:justify-center sm:pt-0">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="h-20 w-20 fill-current text-gray-500" />
                </a>
            </div>

            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
