@extends('base')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <style>
        #avatar-container {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
        }

        #avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        #user-row div:first-child {
            display: flex;
            justify-content: center;
        }

        @media screen and (max-width: 767px) {
            #user-row {
                flex-direction: column;
                
            }
            #user-row > div:first-child {
                width: 100%;
                margin-bottom: 50px;
            }
        }
    </style>
@endpush

@section('content')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="divider divider-left">
                    <div class="divider-text" style="background: none;">
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>User Stats</h3></div>
                    </div>
                </div>
            </div>

            <div id="alert">
                {{-- Alert container --}}
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-8">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="user-container">
                                            
                                            <div class="row" id="user-row">
                                                <div class="col-4">
                                                    <div id="avatar-container">';
                                    
                                                        @if($user->avatar == null) 
                                                            <img src="../images/customers/default.jpg" alt="">
                                                        @else
                                                            <img src="../images/users/ {{ $user->avatar }} ">
                                                        @endif               
                                                                            
                                                        </div>
                                                            </div>
                                                                <div class="col-8">
                                                                    <h1> {{ $user->name }} </h1>
                                                                    <h6>Email: {{ $user->email }}</h6>
                                                                    <br>
                                                        @if($user->phonenumber == null)
                                                            <p>Phone: {{ $user->phonenumber }}</p>
                                                        @else 
                                                            <p>Phone: Not Available</p> 
                                                        @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                
                                </section>
                            </div>
                            <div class="col-md-4">
                                <div class="section">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 200px;">
                                                <h1 class="d-flex" style="font-size: 54px;"><span style="font-size: 20px;">$</span>{{ $totalSale }}</h1>
                                                <p style="font-size: 20px; font-weight: bold;">Total Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="mb-3">Calculate Comission</h3>
                                        <form id="commission-calculate-rate">
                                            <div class="row">
                                                <div class="col-lg-4 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Start Date</span>
                                                        <input type="date" name="start_date" class="form-control" placeholder="Addon to left" aria-describedby="basic-addon1" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">End Date</span>
                                                        <input type="date" name="end_date" class="form-control" placeholder="Addon to left" aria-describedby="basic-addon1" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-2 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" name="rate" class="form-control" placeholder="Rate(%)" step="0.01" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <div class="col-lg-2 mb-1">
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-primary w-100">Calculate</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Calculation Result --}}
                        <div class="row" id="calculation-result-container">
                            {{-- Loader --}}
                            <div class="p-2 text-center" id="commission-calculate-div-loader" style="display: none;">
                                <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 8rem" alt="loader">
                            </div>

                        </div>

                    </div>
                </section>
            </div>

            @include('footer')


            <!-- update profile Modal -->
            



        </div>

        

@endsection   

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });


            // Alert function
            function showAlert(message, type) {
                var alertDiv = $('#alert');
                alertDiv.html(`<div class="alert alert-`+ type +` alert-dismissible show fade">
                                    `+message+`
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`);

            }


            // Calculate commission rate
            var commissionCalculatForm = $('#commission-calculate-rate');

            commissionCalculatForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#commission-calculate-div-loader');

                $.ajax({
                    url: "{{ route('calculate-commission') }}",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#calculation-result-container').html(data);
                            commissionCalculatForm.trigger("reset");
                        }, 500);
                    }
                });
                
            });


        });

    </script>
@endpush