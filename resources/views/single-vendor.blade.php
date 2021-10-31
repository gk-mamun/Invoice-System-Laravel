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
                       
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    @if(count($vendor->invoices) > 0)
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Doc No</th>
                                                    <th>Passport</th>
                                                    <th>Ticket</th>
                                                    <th>Passenger Name</th>
                                                    <th>Travel Date</th>
                                                    <th>Fare</th>
                                                    <th>Credit</th>
                                                    <th>Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    @foreach ($vendor->invoices as $invoice)
                                                        <tr>
                                                            <td>{{ $invoice->doc_no }}</td>
                                                            <td>{{ $invoice->passport }}</td>
                                                            <td>{{ $invoice->ticket }}</td>
                                                            <td>{{ $invoice->passenger }}</td>
                                                            <td>{{ $invoice->travel_date }}</td>
                                                            <td>{{ $invoice->fare }}</td>
                                                            <td>{{ $invoice->credit }}</td>
                                                            <td>{{ $invoice->total }}</td>
                                                        </tr>
                                                    @endforeach
                                                
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="pt-4 pb-2">
                                            <p class="text-center">There is no invoice for this vendor.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
        
                        </section>
                       
                    </div>
                </section>
            </div>

            @include('footer')


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
                        <form class="form form-vertical">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Type</label>
                                                <input type="text" id="inoice-type"
                                                    class="form-control" name="invoice_type"
                                                    placeholder="Invoice type...">
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
                        <form class="form form-vertical">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Type</label>
                                                <input type="text" id="inoice-type"
                                                    class="form-control" name="invoice_type"
                                                    placeholder="Invoice type...">
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
                        <form class="form form-vertical">
                            <input type="text" value=":type_id">
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