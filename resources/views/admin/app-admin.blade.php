<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-slate-100">

    <div id="app-admin" class="w-full">

        <!-- include sidebar -->
        @include('admin.layouts.sidebar')

        <!-- main content -->
        <div class="flex-1 p-4 sm:ml-64">
            <header>
                @include('admin.layouts.header')
            </header>

            <main class="mt-4">
                <h1 class="text-2xl font-semibold text-gray-900 text-center">administração casamento merda bet</h1>
                @yield('content')
            </main>

            <footer class="mt-4">
                @include('admin.layouts.footer')
            </footer>
        </div>
    </div>

</body>
</html>
