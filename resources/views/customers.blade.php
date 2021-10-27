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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Customers</h3></div>
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
                                <button type="button" class="btn btn-outline-primary block float-end"
                                data-bs-toggle="modal" data-bs-target="#addNewCustomerModal">
                                Add New Customer
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="customers-table">
                                            
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

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="#">A. Saugi</a></p>
                    </div>
                </div>
            </footer>


            <!-- Add New Customer Modal -->
            <div class="modal fade" id="addNewCustomerModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Customer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        {{-- Loader --}}
                        <div class="p-2 text-center" id="add-customer-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="create-customer-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Customer/Agency Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Customer name..." id="customer-name" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Email</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control" placeholder="Email..." id="customer-email" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Mobile/Telephone</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Telephone..." id="customer-phone" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Code</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Code..." id="customer-code" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Address</label>
                                                <div class="position-relative">
                                                    <textarea class="form-control" placeholder="Address..." id="customer-address" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                </div>
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


            <!-- Edit Customer Modal -->
            <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Customer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="update-customer-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="update-customer-form">
                            <div class="modal-body">
                                <input type="hidden" id="new-customer-id">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Customer/Agency Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="new-customer-name" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Email</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control" id="new-customer-email" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Mobile/Telephone</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="new-customer-phone" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Code</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="new-customer-code" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Address</label>
                                                <div class="position-relative">
                                                    <textarea class="form-control" id="new-customer-address" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                </div>
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


            <!-- Delete Customer Modal -->
            <div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure?</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="delete-customer-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="delete-customer-modal">
                            <input type="text" id="delete-customer-id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-danger me-1 mb-1">Delete</button>
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
        // Simple Datatable
        // let table1 = document.querySelector('#table1');
        // let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            var customerTable = $('#customers-table');

            // Alert function
            function showAlert(message, type) {
                var alertDiv = $('#alert');
                alertDiv.html(`<div class="alert alert-`+ type +` alert-dismissible show fade">
                                    `+message+`
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`);

            }

            // Get Invoice Type to update
            function getUpdateCustomerData(btn) {
                
                btn.click(function() {
                    var customerId = $(this).data('id');
                    var updateUrl = "{{ route('get-single-customer-to-update', ':id') }}";
                    updateUrl = updateUrl.replace(':id', customerId);
                    $.ajax({
                        url: updateUrl,
                        type: "GET",
                        success: function(data) {
                            $('#new-customer-id').val(data.id);
                            $('#new-customer-name').val(data.title);
                            $('#new-customer-email').val(data.email);
                            $('#new-customer-phone').val(data.phone);
                            $('#new-customer-code').val(data.code);
                            $('#new-customer-address').val(data.address);
                            
                        },
                        error: function (errormessage) {
                            showAlert(errormessage.responseText, "danger");
                        }
                    });
                
                })
            }

            // Update Customer 
            var updateCustomerForm = $('#update-customer-form');

            updateCustomerForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#update-customer-form-loader');
                var newCustomerId = $('#new-customer-id').val();
                var newCustomerTitle = $('#new-customer-name').val();
                var newCustomerEmail = $('#new-customer-email').val();
                var newCustomerPhone = $('#new-customer-phone').val();
                var newCustomerCode = $('#new-customer-code').val();
                var newCustomerAddress = $('#new-customer-address').val();

                $.ajax({
                    url: "{{ route('update-customer') }}",
                    type: "POST",
                    data: {
                        newId: newCustomerId,
                        newTitle: newCustomerTitle,
                        newEmail: newCustomerEmail,
                        newPhone: newCustomerPhone,
                        newCode: newCustomerCode,
                        newAddress: newCustomerAddress
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#editCustomerModal').modal('hide');
                            showAlert("Customer is updated successfully", "success");
                            readCustomers();
                        }, 500);
                        
                    }
                });
            });


            // Show Delete Customer data to modal
            function showDeleteCustomerData(btn) {
                btn.click(function() {
                    var deleteCustomerId = $('#delete-customer-id');
                    deleteCustomerId.val($(this).data('id'));
                })
            }


            // Delete Invoice Type
            var deleteCustomerForm = $('#delete-customer-modal');

            deleteCustomerForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#delete-customer-form-loader');
                var deleteCustomerId = $('#delete-customer-id').val();

                $.ajax({
                    url: "{{ route('delete-customer') }}",
                    type: "POST",
                    data: {
                        deleteId: deleteCustomerId,
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#deleteCustomerModal').modal('hide');
                            showAlert("Customer is deleted successfully", "success");
                            readCustomers();
                        }, 500);
                        
                    }
                });

            });


            // Read all invoice types
            function readCustomers() {
                $.ajax({
                    url: "{{ route('read-customers') }}",
                    type: "GET",
                    success: function(data) {
                        customerTable.html(data);
                        var table1 = document.querySelector('#table1');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var updateBtn = $('.customer-update-btn');
                        getUpdateCustomerData(updateBtn);
                        var deleteBtn = $('.customer-delete-btn');
                        showDeleteCustomerData(deleteBtn);
                    },
                    error: function (errormessage) {
                        showAlert(errormessage.responseText, "danger");
                    }
                });
            };
            readCustomers();


            // Create customer functionalities
            var createCustomerForm = $('#create-customer-form');

            createCustomerForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#add-customer-form-loader');
                var title = $('#customer-name').val();
                var email = $('#customer-email').val();
                var phone = $('#customer-phone').val();
                var code = $('#customer-code').val();
                var address = $('#customer-address').val();


                $.ajax({
                    url: "{{ route('create-customer') }}",
                    type: "POST",
                    data: {
                        title,
                        email,
                        phone,
                        code,
                        address
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#addNewCustomerModal').modal('hide');
                            showAlert("Customer is created successfully", "success");
                            readCustomers();
                        }, 500);
                        
                    }
                });
            });

        });
    </script>
@endpush