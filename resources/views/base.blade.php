<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/gif">
    <style>
        #sidebar-user-info {
            position: absolute;
            bottom: 50px;
            width: 100%;
        }
        #sidebar-user-info form {
            cursor: pointer;
        }
        #sidebar-user-info form button,
        #sidebar-user-info form button:focus {
            border: none;
            background: none;
            margin-top: 2px;
            outline: none;
        }

    </style>
    @stack('stylesheets')
</head>

<body>
    <div id="app">
        
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logo/company-logo.jpg') }}" alt="Logo" srcset="" style="height: 5rem;"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ (request()->is('home')) ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{ (request()->is('invoices')) ? 'active' : '' }}">
                            <a href="{{ route('invoices') }}" class='sidebar-link'>
                                <i class="bi bi-file-post"></i>
                                <span>Laser Invoices</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ (request()->is('customers')) ? 'active' : '' }}">
                            <a href="{{ route('customers') }}" class='sidebar-link'>
                                <i class="bi bi-building"></i>
                                <span>Customer</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ (request()->is('our-vendors')) ? 'active' : '' }}">
                            <a href="{{ route('vendors') }}" class='sidebar-link'>
                                <i class="bi bi-hdd-network-fill"></i>
                                <span>Vendor</span>
                            </a>
                        </li>

                        @if(auth()->user()->role == 'admin') 
                            <li class="sidebar-item {{ (request()->is('users')) ? 'active' : '' }}">
                                <a href="{{ route('users') }}" class='sidebar-link'>
                                    <i class="bi bi-person-square"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item {{ (request()->is('setting')) ? 'active' : '' }}">
                            <a href="{{ route('setting') }}" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Setting</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                <div id="sidebar-user-info" class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" class="sidebar-link">
                                @csrf
                                <i class="bi bi-unlock-fill"></i>
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        @yield('content')
        
    </div>


    <script src="{{ asset("vendors/perfect-scrollbar/perfect-scrollbar.min.js") }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- <script src="{{ asset('vendors/apexcharts/apexcharts.js') }}"></script> --}}
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
    @stack('script')
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>