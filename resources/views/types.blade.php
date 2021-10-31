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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Laser Invoice Types</h3></div>
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
                                data-bs-toggle="modal" data-bs-target="#addNewTypeModal">
                                Add New Type
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="invoice-type-table">
                                            
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


            <!-- Add New Type Modal -->
            <div class="modal fade" id="addNewTypeModal" tabindex="-1" role="dialog"
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
                        <div class="p-2 text-center" id="add-type-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="create-type-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Type</label>
                                                <input type="text" id="invoice-type"
                                                    class="form-control" name="invoice_type"
                                                    placeholder="Invoice type..." required>
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


            <!-- Edit Type Modal -->
            <div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Update Type of Invoice/Laser</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="update-type-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="update-type-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Type</label>
                                                <input type="text" id="new-invoice-type"
                                                    class="form-control" name="invoice_type"
                                                    placeholder="Invoice type..." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="new-invoice-id">
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


            <!--Delete Type Modal -->
            <div class="modal fade" id="deleteTypeModal" tabindex="-1" role="dialog"
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
                        <div class="p-2 text-center" id="delete-type-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="delete-type-modal">
                            <input type="hidden" id="delete-type-id">
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


            var invoiceTable = $('#invoice-type-table');

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
            function getUpdateTypeData(btn) {
                
                btn.click(function() {
                    var typeId = $(this).data('id')
                    var newInvoiceId = $('#new-invoice-id');
                    var newInvoiceType = $('#new-invoice-type');
                    var updateUrl = "{{ route('get-single-type', ':id') }}";
                    updateUrl = updateUrl.replace(':id', typeId);
                    $.ajax({
                        url: updateUrl,
                        type: "GET",
                        success: function(data) {
                            newInvoiceId.val(data.id);
                            newInvoiceType.val(data.title);
                            
                        },
                        error: function (errormessage) {
                            console.log(errormessage.responseText);
                        }
                    });
                
                })
            }

            // Update invoice type
            var updateTypeForm = $('#update-type-form');

            updateTypeForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#update-type-form-loader');
                var newInvoiceId = $('#new-invoice-id').val();
                var newInvoiceTitle = $('#new-invoice-type').val();

                $.ajax({
                    url: "{{ route('update-type') }}",
                    type: "POST",
                    data: {
                        newId: newInvoiceId,
                        newTitle: newInvoiceTitle,
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#editTypeModal').modal('hide');
                            showAlert("Invoice type is updated successfully", "success");
                            readInvoiceTypes();
                        }, 500);
                        
                    }
                });
            });


            // Show Delete Type data to modal
            function showDeleteTypeData(btn) {
                btn.click(function() {
                    var deleteTypeId = $('#delete-type-id');
                    deleteTypeId.val($(this).data('id'));
                })
            }

            // Delete Invoice Type
            var deleteTypeForm = $('#delete-type-modal');

            deleteTypeForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#delete-type-form-loader');
                var deleteTypeId = $('#delete-type-id').val();

                $.ajax({
                    url: "{{ route('delete-type') }}",
                    type: "POST",
                    data: {
                        deleteId: deleteTypeId,
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#deleteTypeModal').modal('hide');
                            showAlert("Invoice type is deleted successfully", "success");
                            readInvoiceTypes();
                        }, 500);
                        
                    }
                });

            });

            // Read all invoice types
            function readInvoiceTypes() {
                $.ajax({
                    url: "{{ route('read-invoice-types') }}",
                    type: "GET",
                    success: function(data) {
                        invoiceTable.html(data);
                        var table1 = document.querySelector('#table1');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var updateBtn = $('.type-update-btn');
                        getUpdateTypeData(updateBtn);
                        var deleteBtn = $('.type-delete-btn');
                        showDeleteTypeData(deleteBtn);
                    },
                    error: function (errormessage) {
                        console.log(errormessage.responseText);
                    }
                });
            };
            readInvoiceTypes();

            // Create Invoice Type functionalities
            var createTypeForm = $('#create-type-form');

            createTypeForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#add-type-form-loader');
                var typeTitle = $('#invoice-type').val();

                $.ajax({
                    url: "{{ route('create-type') }}",
                    type: "POST",
                    data: {
                        title: typeTitle
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#addNewTypeModal').modal('hide');
                            showAlert("Invoice type is created successfully", "success");
                            readInvoiceTypes();
                        }, 500);
                        
                    }
                });
            });


        });
        
    </script>
@endpush