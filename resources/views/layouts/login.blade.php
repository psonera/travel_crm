<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/img/favicon.png" />
    <title>Admin Login</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="/css/styles.css?v=1.0.2" rel="stylesheet" />

</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-size-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        {{ $slot }}
    </main>
    <footer class="py-12">
        <div class="container">
            <div class="flex flex-wrap -mx-3">
                <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                    <p class="mb-0 text-slate-400">
                        Copyright ©
                        2022,
                        made with <i class="fa fa-heart"></i> by
                        <a class="font-semibold text-slate-700">Developers</a>
                        for a better web.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    @if (session()->has('error'))
        <div class="bg-black bottom-7.5 fixed flash_msg p-4 px-4 right-3 right-4 rounded-xl text-lg text-white">
            <p class="mb-0">{{ session('error') }}</p>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.flash_msg').fadeOut('slow');
            }, 3000);
        });
    </script>
</body>

<!-- main script file  -->
<script src="/js/soft-ui-dashboard-tailwind.js?v=1.0.2" async></script>

</html>
