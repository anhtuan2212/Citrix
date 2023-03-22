<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Citrịx
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('./assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('./assets/css/personnel.css') }}" rel="stylesheet" />
    <link href="{{ asset('./assets/css/nucleo-svg.css" rel="stylesheet') }}" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('jqueryui/jquery-ui.min.css') }}">
    <!-- Sweetalert2 -->
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .no-border {
            border: 0;
            box-shadow: none;
        }

        .no-border:disabled {
            background: white;
            cursor: auto
        }

        ul.ui-autocomplete {
            z-index: 1100;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;

            .avtice_loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 9999999;
            }

            .active_body {
                opacity: 0.5
            }

            .hide_loading {
                opacity: 0;
                display: none;
            }

            .sk-cube-grid {
                opacity: 1;
                width: 40px;
                height: 40px;
                margin: 100px auto;
            }

            .sk-cube-grid .sk-cube {
                width: 33%;
                height: 33%;
                background-color: #000000;
                float: left;
                -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
                animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            }

            .sk-cube-grid .sk-cube1 {
                -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s;
            }

            .sk-cube-grid .sk-cube2 {
                -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s;
            }

            .sk-cube-grid .sk-cube3 {
                -webkit-animation-delay: 0.4s;
                animation-delay: 0.4s;
            }

            .sk-cube-grid .sk-cube4 {
                -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s;
            }

            .sk-cube-grid .sk-cube5 {
                -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s;
            }

            .sk-cube-grid .sk-cube6 {
                -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s;
            }

            .sk-cube-grid .sk-cube7 {
                -webkit-animation-delay: 0s;
                animation-delay: 0s;
            }

            .sk-cube-grid .sk-cube8 {
                -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s;
            }

            .sk-cube-grid .sk-cube9 {
                -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s;
            }

            @-webkit-keyframes sk-cubeGridScaleDelay {

                0%,
                70%,
                100% {
                    -webkit-transform: scale3D(1, 1, 1);
                    transform: scale3D(1, 1, 1);
                }

                35% {
                    -webkit-transform: scale3D(0, 0, 1);
                    transform: scale3D(0, 0, 1);
                }
            }

            @keyframes sk-cubeGridScaleDelay {

                0%,
                70%,
                100% {
                    -webkit-transform: scale3D(1, 1, 1);
                    transform: scale3D(1, 1, 1);
                }

                35% {
                    -webkit-transform: scale3D(0, 0, 1);
                    transform: scale3D(0, 0, 1);
                }
            }
    </style>
</head>

<body id="id_body" class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(),
                ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (
                !in_array(request()->route()->getName(),
                    ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100" style="z-index: -9;"></div>
            @elseif (in_array(request()->route()->getName(),
                    ['profile-static', 'profile']))
                <div class="position-absolute w-100 min-height-300 top-0"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
            <main class="main-content border-radius-lg">
                @yield('content')
            </main>
        @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!--   Core JS Files   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/authority.js') }}"></script>
    <script src="{{ asset('assets/js/core/personnel.js') }}"></script>
    <script src="{{ asset('assets/js/equipment.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    @yield('javascript')
    @stack('js')
    @stack('department_handler')
    @stack('position_handler')
    @stack('overview')
</body>

</html>
