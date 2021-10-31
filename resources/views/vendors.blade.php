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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Vendors</h3></div>
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
                                data-bs-toggle="modal" data-bs-target="#addVendorModal">
                                Add New Vendor
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="vendor-table">
                                            
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


            <!-- add New vendor modal -->
            <div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Type of Invoice/Laser</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        
                        {{-- Loader --}}
                        <div class="p-2 text-center" id="add-vendor-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="create-vendor-form" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Vendor Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Vendor name..." id="vendor-name" name="vendor_name" required>
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
                                                    <input type="email" class="form-control" placeholder="Email..." id="vendor-email" name="vendor_email" required>
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
                                                    <input type="text" class="form-control" placeholder="Telephone..." id="vendor-phone" name="vendor_phone" required>
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
                                                    <input type="text" class="form-control" placeholder="Code..." id="vendor-code" name="vendor_code" required>
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
                                                    <textarea class="form-control" placeholder="Address..." id="vendor-address" name="vendor_address" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Profile Picture (Optional)</label>
                                                <div class="position-relative">
                                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                                    
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


            <!-- Edit Vendor Modal -->
            <div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Type of Invoice/Laser</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        
                        {{-- Loader --}}
                        <div class="p-2 text-center" id="update-vendor-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="update-vendor-form" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <input type="hidden" id="new-vendor-id" name="vendor_id">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Vendor Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Vendor name..." id="new-vendor-name" name="vendor_name" required>
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
                                                    <input type="email" class="form-control" placeholder="Email..." id="new-vendor-email" name="vendor_email" required>
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
                                                    <input type="text" class="form-control" placeholder="Telephone..." id="new-vendor-phone" name="vendor_phone" required>
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
                                                    <input type="text" class="form-control" placeholder="Code..." id="new-vendor-code" name="vendor_code" required>
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
                                                    <textarea class="form-control" placeholder="Address..." id="new-vendor-address" name="vendor_address" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Profile Picture (Optional)</label>
                                                <div class="position-relative">
                                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                                    
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


            <!-- Vertically Centered modal Modal -->
            <div class="modal fade" id="deleteVendorModal" tabindex="-1" role="dialog"
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
                        <div class="p-2 text-center" id="delete-vendor-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="delete-vendor-form">
                            <input type="hidden" id="delete-vendor-id">
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            var vendorTable = $('#vendor-table');

            // Alert function
            function showAlert(message, type) {
                var alertDiv = $('#alert');
                alertDiv.html(`<div class="alert alert-`+ type +` alert-dismissible show fade">
                                    `+message+`
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`);

            }

            // Get vendor data to update
            function getUpdateVendorData(btn) {
                
                btn.click(function() {
                    var vendorId = $(this).data('id');
                    var updateUrl = "{{ route('get-single-vendor-to-update', ':id') }}";
                    updateUrl = updateUrl.replace(':id', vendorId);
                    $.ajax({
                        url: updateUrl,
                        type: "GET",
                        success: function(data) {
                            $('#new-vendor-id').val(data.id);
                            $('#new-vendor-name').val(data.title);
                            $('#new-vendor-email').val(data.email);
                            $('#new-vendor-phone').val(data.phone);
                            $('#new-vendor-code').val(data.code);
                            $('#new-vendor-address').val(data.address);
                            
                        },
                        error: function (errormessage) {
                            showAlert(errormessage.responseText, "danger");
                        }
                    });
                
                })
            }

            // Update Customer 
            var updateVendorForm = $('#update-vendor-form');

            updateVendorForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#update-vendor-form-loader');
                
                $.ajax({
                    url: "{{ route('update-vendor') }}",
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
                            $('#editVendorModal').modal('hide');
                            showAlert("Vendor is updated successfully", "success");
                            readVendors();
                        }, 500);
                        
                    }
                });
            });

            // Show Delete vendor data to modal
            function showDeleteVendorData(btn) {
                btn.click(function() {
                    var deleteVendorId = $('#delete-vendor-id');
                    deleteVendorId.val($(this).data('id'));
                })
            }

            // Delete Invoice Type
            var deleteVendorForm = $('#delete-vendor-form');

            deleteVendorForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#delete-vendor-form-loader');
                var deleteVendorId = $('#delete-vendor-id').val();

                $.ajax({
                    url: "{{ route('delete-vendor') }}",
                    type: "POST",
                    data: {
                        deleteId: deleteVendorId,
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#deleteVendorModal').modal('hide');
                            showAlert("Vendor is deleted successfully", "success");
                            readVendors();
                        }, 500);
                        
                    }
                });

            });

            // Read all vendor
            function readVendors() {
                $.ajax({
                    url: "{{ route('read-vendor') }}",
                    type: "GET",
                    success: function(data) {
                        vendorTable.html(data);
                        var table1 = document.querySelector('#table1');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var updateBtn = $('.vendor-update-btn');
                        getUpdateVendorData(updateBtn);
                        var deleteBtn = $('.vendor-delete-btn');
                        showDeleteVendorData(deleteBtn);
                    },
                    error: function (errormessage) {
                        showAlert(errormessage.responseText, "danger");
                    }
                });
            };
            readVendors();


            // Create customer functionalities
            var createVendorForm = $('#create-vendor-form');

            createVendorForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#add-vendor-form-loader');

                $.ajax({
                    url: "{{ route('create-vendor') }}",
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
                            $('#addVendorModal').modal('hide');
                            showAlert("Vendor is created successfully", "success");
                            readVendors();
                            console.log(data);
                        }, 500);
                        
                    }
                });
            });


        });


        
    </script>
@endpush