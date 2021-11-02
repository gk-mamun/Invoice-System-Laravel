@extends('base')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Invoices</h3></div>
                    </div>
                </div>
            </div>
            <div id="alert">
                {{-- Alert container --}}
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <!-- button trigger for  Add new invoice type modal -->
                                <button type="button" class="btn btn-outline-primary block float-end add-new-invoice-btn"
                                data-bs-toggle="modal" data-bs-target="#addNewInvoiceModal">
                                Create New Invoice
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="invoices-table">
                                            
                                            <div>
                                                <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" alt="Loader" style="margin: 50px auto; display: block; width: 8rem;">
                                            </div>

                                        </div>
                                    </div>
                
                                </section>
                            </div>
                        </div>
                       
                    </div>
                </section>
            </div>

            @include('footer')

        
            <!-- Add New Invoice Modal -->
            <div class="modal fade" id="addNewInvoiceModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content" style="overflow-y: auto;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Type of Invoice/Laser</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        {{-- Loader --}}
                        <div class="p-2 text-center" id="add-invoice-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="create-invoice-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Doc No.</label>
                                                <input type="text" class="form-control" id="doc-no" placeholder="Document no..." disabled required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Passport No.</label>
                                                <input type="text" class="form-control" id="passport" placeholder="Passport no...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Ticket</label>
                                                <input type="text" class="form-control" id="ticket" placeholder="Ticket...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>PNR</label>
                                                <input type="text" class="form-control" id="pnr" placeholder="PNR...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Passenger Name</label>
                                                <input type="text" class="form-control" id="passenger" placeholder="Passenger Name...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Sector</label>
                                                <input type="text" class="form-control" id="sector" placeholder="Sector...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Travel Date</label>
                                                <input type="date" class="form-control" id="travel-date" placeholder="Travel Date...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Purchased Fare</label>
                                                <input type="text" class="form-control" id="parchased-fare" placeholder="Purchased Fare..." required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Selling Fare</label>
                                                <input type="text" class="form-control" id="selling-fare" placeholder="Selling Fare..." required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Invoice Type</label>
                                                <select class="choices form-select" id="type" required>
                                                    <option selected disabled>Choose Invoice type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <select class="choices form-select" id="customer" required>
                                                    <option selected disabled>Select Customer</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Vendor</label>
                                                <select class="choices form-select" id="vendor" required>
                                                    <option selected disabled>Select Vendor</option>
                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        

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


            // Get last invoice doc no
            $('.add-new-invoice-btn').click(function() {

                $.ajax({
                    url: "{{ route('get-last-invoice-doc-no') }}",
                    type: "GET",
                    success: function(data) {
                        var newDocNo = 'ATI' + data;
                        $('#doc-no').val(newDocNo);
                    },
                    error: function(errormessage) {
                        showAler(errormessage.responseText, 'danger')
                    }
                })
            });


            // Read all invoices
            function readInvoices() {
                $.ajax({
                    url: "{{ route('read-invoice') }}",
                    type: "GET",
                    success: function(data) {
                        $('#invoices-table').html(data);
                        var table1 = document.querySelector('#customerTable');
                        var table2 = document.querySelector('#vendorTable');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var dataTable2 = new simpleDatatables.DataTable(table2);
                    },
                    error: function (errormessage) {
                        console.log(errormessage.responseText);
                    }
                });
            };
            readInvoices();


            // Create customer functionalities
            var createInvoiceForm = $('#create-invoice-form');

            createInvoiceForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#add-invoice-form-loader');

                var docNo = $('#doc-no').val();
                var passport = $('#passport').val();
                var ticket = $('#ticket').val();
                var pnr = $('#pnr').val();
                var passenger = $('#passenger').val();
                var sector = $('#sector').val();
                var travelDate = $('#travel-date').val();
                var purchasedFare = $('#parchased-fare').val();
                var sellingFare = $('#selling-fare').val();
                var type = $('#type').val();
                var customer = $('#customer').val();
                var vendor = $('#vendor').val();

                $.ajax({
                    url: "{{ route('create-invoice') }}",
                    type: "POST",
                    data: {
                        docNo,
                        passport,
                        ticket,
                        pnr,
                        passenger,
                        sector,
                        travelDate,
                        purchasedFare,
                        sellingFare,
                        type,
                        customer,
                        vendor
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#addNewInvoiceModal').modal('hide');
                            showAlert("Invoice is created successfully", "success");
                            readInvoices();
                            createInvoiceForm.trigger("reset");
                        }, 500);
                        
                    }
                });


            });



        });
    </script>
    
@endpush