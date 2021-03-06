@extends('base')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/customer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/laser.css') }}">
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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Vendor</h3></div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        
                        <div class="col-12 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body text-center" id="customer-info-div">
                                        @if ($vendor->avatar)
                                            <img src="{{ asset('images/vendor/' . $vendor->avatar) }}" id="avatar"/>
                                        @else
                                            <img src="{{ asset('images/customers/default.jpg') }}" id="avatar"/>
                                        @endif
                                        <h1 class="card-title">{{ $vendor->title }}</h1>

                                        <p class="card-text">{{ $vendor->email }}</p>
                                        <p class="card-text">{{ $vendor->phone }}</p>
                                        <p class="card-text">{{ $vendor->address }}</p>
                                        <p class="card-text">Cupcake fruitcake macaroon donut</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" id="create-vendor-lazer-form">
                                        <div class="row">
                                            <input type="hidden" name="receiver_id" value="{{ $vendor->id }}">
                                            <input type="hidden" name="receiver" value="vendor">
                                            <div class="col-lg-4 mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3-range-fill"></i></span>
                                                    <input type="date" class="form-control" name="start_date" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3-range-fill"></i></span>
                                                    <input type="date" class="form-control" name="end_date" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 mb-1">
                                                <div class="input-group">
                                                    <input type="submit" class="btn btn-primary" value="Create Laser" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="laser-generate-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <div class="p-3 text-center" id="pdf-generate-btn-container" style="display: none">
                            <button id="pdf-generate-btn" onclick="getPDF()" class="btn btn-primary">Download PDF</button>
                        </div>

                        <section class="section" id="laser-container">
                            
                        </section>
                       
                        <section class="section" id="vendor-invoices">

                            <div class="p-2 text-center">
                                <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 8rem" alt="loader">
                            </div>

                        </section>
                       
                    </div>
                </section>
            </div>

            @include('footer')


            <!-- Edit InVoice Modal -->
            <div class="modal fade" id="editInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content" style="overflow-y: auto;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Update Invoice/Laser</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="update-invoice-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="update-invoice-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Doc No.</label>
                                                <input type="text" class="form-control" id="doc-no" name="doc_no" placeholder="Document no..." disabled required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Passport No.</label>
                                                <input type="text" class="form-control" id="passport" name="passport" placeholder="Passport no...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Ticket</label>
                                                <input type="text" class="form-control" id="ticket" name="ticket" placeholder="Ticket...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>PNR</label>
                                                <input type="text" class="form-control" id="pnr" name="pnr" placeholder="PNR...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Passenger Name</label>
                                                <input type="text" class="form-control" id="passenger" name="passenger" placeholder="Passenger Name...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Sector</label>
                                                <input type="text" class="form-control" id="sector" name="sector" placeholder="Sector...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Travel Date</label>
                                                <input type="date" class="form-control" id="travel-date" name="travel_date" placeholder="Travel Date...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Fare</label>
                                                <input type="text" class="form-control" id="fare" name="fare" placeholder="Fare..." required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control" id="status" name="status" placeholder="Status...">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Invoice Type</label>
                                                <select class="choices form-select" id="type" name="type" required>
                                                    <option selected disabled>Choose Invoice type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>

                                <input type="hidden" id="edit-invoice-id" name="edit_invoice_id">
                                <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!--Delete Invoice Modal -->
            <div class="modal fade" id="deleteInvoiceModal" tabindex="-1" role="dialog"
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
                        <div class="p-2 text-center" id="delete-invoice-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="delete-invoice-form">
                            <input type="hidden" id="delete-invoice-id" name="delete_invoice_id">
                            <input type="hidden"  name="vendor_id" value="{{ $vendor->id }}">
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

            <!--Void Invoice Modal -->
            <div class="modal fade" id="voidInvoiceModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Void Invoice</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        {{-- Loader --}}
                        <div class="p-2 text-center" id="void-invoice-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="void-invoice-form">
                            <input type="hidden" id="void-invoice-id" name="void_invoice_id">
                            <input type="hidden"  name="vendor_id" value="{{ $vendor->id }}">
                            <input type="hidden" name="status" value="void">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Fare</label>
                                            <input type="text" class="form-control" id="void-modal-fare" name="fare" placeholder="Fare..." required>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input type="text" class="form-control" id="status" name="status" placeholder="Status...">
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Void</button>
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
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
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

           var createLaserForm = $('#create-vendor-lazer-form');

           createLaserForm.on('submit', function(e) {
               e.preventDefault();

               var loader = $('#laser-generate-loader');

               $.ajax({
                   url: "{{ route('generate-laser') }}",
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
                           $('#laser-container').html(data);
                           $('#pdf-generate-btn-container').show();
                       }, 500);
                       
                   }
               });

           });


           function getInvoiceDataToUpdate(btn) {
                btn.click(function() {
                    var invoiceId = $(this).data('id');
                    var invoiceVendorId = $(this).data('vendorid');

                    $.ajax({
                        url: "{{ route('get-vendor-single-invoice-data') }}",
                        type: "POST",
                        data: {
                            invoiceId,
                            invoiceVendorId,
                        },
                        success: function(data) {
                            console.log(data.id);
                            $('#edit-invoice-id').val(data.id);
                            $('#doc-no').val(data.doc_no);
                            $('#passport').val(data.passport);
                            $('#ticket').val(data.ticket);
                            $('#pnr').val(data.pnr);
                            $('#passenger').val(data.passenger);
                            $('#sector').val(data.sector);
                            $('#travel-date').val(data.travel_date);
                            $('#fare').val(data.fare);
                            $('#status').val(data.status);
                            $("#type").val(data.type_id);
                        }
                    })
                });
           }

           // Show Delete Invoice data to modal
            function showDeleteInvoiceData(btn) {
                btn.click(function() {
                    var deleteInvoiceId = $('#delete-invoice-id');
                    deleteInvoiceId.val($(this).data('id'));
                })
            }

            // Show Void Invoice data to modal
            function showVoidInvoiceData(btn) {
                btn.click(function() {
                    $('#void-invoice-id').val($(this).data('id'));
                    $('#void-modal-fare').val($(this).data('fare'));
                })
            }

           // Read all customer's invoices
           function readVendorInvoices() {
                var id = "{{ $vendor->id }}";
                var url = '{{ route("read-vendor-invoice", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        $('#vendor-invoices').html(data);
                        var table1 = document.querySelector('#table1');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var updateBtn = $('.invoice-update-btn');
                        var deleteBtn = $('.invoice-delete-btn');
                        var voidBtn = $('.invoice-void-btn');
                        getInvoiceDataToUpdate(updateBtn);
                        showDeleteInvoiceData(deleteBtn);
                        showVoidInvoiceData(voidBtn);
                    },
                    error: function (errormessage) {
                        console.log(errormessage.responseText);
                    }
                });
           };
           readVendorInvoices();

           // Invoice Update functionalities
           var updateInvoiceForm = $('#update-invoice-form');

            updateInvoiceForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#update-invoice-form-loader');

                $.ajax({
                    url: "{{ route('update-vendor-invoice') }}",
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
                            $('#editInvoiceModal').modal('hide');
                            showAlert("Invoice is updated successfully", "success");
                            readVendorInvoices();
                            updateInvoiceForm.trigger("reset");
                        }, 500);
                        
                    }
                });


            });
           
            // Invoice delete functionalities
            var deleteInvoiceForm = $('#delete-invoice-form');

            deleteInvoiceForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#delete-invoice-form-loader');

                $.ajax({
                    url: "{{ route('delete-vendor-invoice') }}",
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
                            $('#deleteInvoiceModal').modal('hide');
                            showAlert("Invoice is deleted successfully", "success");
                            readVendorInvoices();
                            deleteInvoiceForm.trigger("reset");
                            console.log(data);
                        }, 500);
                    }
                });
            });

            // Invoice void functionalities
            var voidInvoiceForm = $('#void-invoice-form');

            voidInvoiceForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#void-invoice-form-loader');

                $.ajax({
                    url: "{{ route('void-vendor-invoice') }}",
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
                            $('#voidInvoiceModal').modal('hide');
                            showAlert("Invoice is being void successfully", "success");
                            readVendorInvoices();
                            voidInvoiceForm.trigger("reset");
                            console.log(data);
                        }, 500);
                    }
                });

            });

        });
   </script>
   <script src="{{ asset('js/jspdf.min.js') }}"></script>
   <script src="{{ asset('js/html2canvas.js') }}"></script>
   <script>
           function getPDF(){

               var HTML_Width = $("#laser-container").width();
               var HTML_Height = $("#laser-container").height();
               var top_left_margin = 15;
               var PDF_Width = HTML_Width+(top_left_margin*2);
               var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
               var canvas_image_width = HTML_Width;
               var canvas_image_height = HTML_Height;

               var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


               html2canvas($("#laser-container")[0],{allowTaint:true}).then(function(canvas) {
                   canvas.getContext('2d');
                   
                   
                   var imgData = canvas.toDataURL("image/jpeg", 1.0);
                   var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                   pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                   
                   
                   for (var i = 1; i <= totalPDFPages; i++) { 
                       pdf.addPage(PDF_Width, PDF_Height);
                       pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                   }
                   
                   var vendorName = "{{ $vendor->title }}";
                   var t = new Date();
                   var d = t.getDay();
                   var m = t.getMonth();
                   var y = t.getFullYear()

                   var fileName = vendorName + '_' + d + '_' + m + '_' + y + '.pdf'  

                   pdf.save(fileName);
               });

           };
   </script>
@endpush