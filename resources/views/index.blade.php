@extends('base')


@section('content')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <img src="{{ asset('images/icons/dollar.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Revenue</h6>
                                                <h6 class="font-extrabold mb-0">$ {{ $revenue }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->role == 'admin') 
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon blue">
                                                        <img src="{{ asset('images/icons/spending.png') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Total Invest</h6>
                                                    <h6 class="font-extrabold mb-0">$ {{ $totalSpending }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon green">
                                                        <img src="{{ asset('images/icons/profit.png') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Profit</h6>
                                                    <h6 class="font-extrabold mb-0">$ {{ $profit }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Invoices</h6>
                                                <h6 class="font-extrabold mb-0">{{ $totalInvoice }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->role == 'staff') 
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon blue">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Total Customer</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $customerNumber }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon green">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Total Vendor</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $vendorNumber }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="card p-3">
                                   <div class="chart">
                                       <canvas id="myChart"></canvas>
                                   </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Recent Customer</h4>
                                    </div>
                                    <div class="card-content pb-4">
                                        @foreach ($recentCustomers as $customer)
                                            <div class="recent-message d-flex px-4 py-3">
                                                <div class="avatar avatar-lg">
                                                    @if($customer->avatar == null)
                                                    <img src="{{ asset('images/customers/default.jpg') }}">
                                                    @else 
                                                    <img src="{{ asset('images/customers/' . $customer->avatar) }}">
                                                    @endif
                                                </div>
                                                <div class="name ms-4">
                                                    <h5 class="mb-1">{{ $customer->title }}</h5>
                                                    <h6 class="text-muted mb-0">{{ $customer->email }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="px-4">
                                            <a href="{{ route('customers') }}" class="btn btn-block btn-xl btn-light-primary font-bold mt-3">See All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Our Users</h4>
                                    </div>
                                    <div class="card-content">
                                        @foreach ($users as $user)
                                            <div class="recent-message d-flex px-4 py-3">
                                                <div class="avatar avatar-lg">
                                                    @if($user->avatar == null)
                                                    <img src="{{ asset('images/customers/default.jpg') }}">
                                                    @else 
                                                    <img src="{{ asset('images/users/' . $user->avatar) }}">
                                                    @endif
                                                </div>
                                                <div class="name ms-4">
                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <h6 class="text-muted mb-0">{{ $user->email }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Recent Vendors</h4>
                                    </div>
                                    <div class="card-content pb-4">
                                        @foreach ($recentVendors as $vendor)
                                            <div class="recent-message d-flex px-4 py-3">
                                                <div class="avatar avatar-lg">
                                                    @if($vendor->avatar == null)
                                                    <img src="{{ asset('images/customers/default.jpg') }}">
                                                    @else 
                                                    <img src="{{ asset('images/vendor/' . $vendor->avatar) }}">
                                                    @endif
                                                </div>
                                                <div class="name ms-4">
                                                    <h5 class="mb-1">{{ $vendor->title }}</h5>
                                                    <h6 class="text-muted mb-0">{{ $vendor->email }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="px-4">
                                            <a href="{{ route('customers') }}" class="btn btn-block btn-xl btn-light-primary font-bold mt-3">See All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    
                </section>
            </div>

            @include('footer')
            {{-- Current Year Monthly Sales --}}
            @php
                $months = [];
                $monthly_sales = [];
                
                foreach ($sales as $sale) {
                    array_push($months, $sale->monthname);
                    array_push($monthly_sales, $sale->total_sale);
                }


                $months = json_encode($months);
                $monthly_sales = json_encode($monthly_sales);
            @endphp

        </div>

@endsection   
@push('script')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let saleMonth = <?php echo $months; ?>;
        let monthlySales = <?php echo $monthly_sales; ?>;
        
        const ctx = document.querySelector('#myChart').getContext("2d");

        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#9694ff');
        gradient.addColorStop(1, 'rgba(255, 121, 118, 0.3)');

        const labels = saleMonth;

        const data = {
            labels,
            datasets: [{
                data: monthlySales,
                label: "This Year Sales",
                fill: true,
                backgroundColor: gradient,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            option: {
                responsive: true,
                scales: {
                    y: {
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        }
                    }
                }
            },
        };

        const myChart = new Chart(ctx, config);

    </script>

@endpush