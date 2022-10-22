<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Thrill Blazers</title>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js"></script>

    <!-- Nucleo Icons -->
    <link href="/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/css/nucleo-svg.css" rel="stylesheet" />
    <link href="/css/styles.css?v=1.0.2" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@4.0.14/css/froala_editor.pkgd.css' rel='stylesheet' type='text/css' />
    
    <link rel="icon" type="image/png" href="/img/favicon.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@4.0.14/js/froala_editor.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    @livewireStyles
    @powerGridStyles
    
    @yield('page_styles')
</head>
<body class="m-0 font-sans antialiased font-normal text-size-base leading-default bg-gray-50 text-slate-500">
    <div id="app">
        @include('layouts.sidebar')
        <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
            <!-- Navbar -->
            @include('layouts.nav')
            <!-- end Navbar -->
            <div class="w-full px-6 py-6 mx-auto">
                {{ $slot }}
                @include('layouts.footer')
            </div>
        </main>
    </div>

    <script src="/js/soft-ui-dashboard-tailwind.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    @livewireScripts
    @powerGridScripts
    @yield('page_scripts')
    @if (session()->has('success'))
        <script>
            const notyf = new Notyf({
                dismissible: true
            })
            notyf.success('{{ session('success') }}')
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            const notyf = new Notyf({
                dismissible: true
            })
            notyf.error('{{ session('error') }}')
        </script>
    @endif
</body>
</html>
