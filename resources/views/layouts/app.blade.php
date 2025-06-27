<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sire</title>

        <link rel="shortcut icon" href="/img/sire-icono.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" href="/toastr/toastr.min.css">

        <link rel="stylesheet" type="text/css" href="/select2/select2.min.css">

        <script type="text/javascript" src="/fontawesome/js/all.min.js"></script>
        <script type="text/javascript" src="/fontawesome/js/brands.min.js"></script>
        <script type="text/javascript" src="/fontawesome/js/fontawesome.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <!-- Scripts -->

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style type="text/css">
            
            .tabla td{ 
                border: 1px solid #f5f5f5;
                padding:10px;
                font-size: 13px; 
            }
            .tabla tbody tr:nth-child(2n+1){
                background: #f5f5f5;
            }
            .form input , .form label ,.form select{
                font-size: 13px;
            }
            .oculto { 
                display: none; 
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/popper.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/toastr/toastr.min.js"></script>
        <script type="text/javascript" src="/select2/select2.min.js"></script>

        <script type="text/javascript">
            
            $(document).ready(function(){
                toastr.options = {
                    "progressBar" : true,
                    "positionClass" : "toast-top-right"
                }
            });

        </script>

        @livewireScripts
            
        <script type="text/javascript">
           if (!window.livewireSuccessListener) {
                window.livewireSuccessListener = true;
                Livewire.on('success', (event) => {
                    toastr.success(event[0].message);
                });
                Livewire.on('error', (event) => {
                    toastr.error(event[0].message);
                });
            }
        </script>

        @yield('scripts')
        
    </body>
</html>
