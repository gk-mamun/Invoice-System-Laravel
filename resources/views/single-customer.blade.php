@extends('base')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/customer.css') }}">
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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Customer</h3></div>
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
                                        @if ($customer->avatar)
                                            <img src="{{ asset('images/customers/' . $customer->avatar) }}" id="avatar"/>
                                        @else
                                            <img src="{{ asset('images/customers/default.jpg') }}" id="avatar"/>
                                        @endif
                                        <h1 class="card-title">{{ $customer->title }}</h1>

                                        <p class="card-text">{{ $customer->email }}</p>
                                        <p class="card-text">{{ $customer->phone }}</p>
                                        <p class="card-text">{{ $customer->address }}</p>
                                        <p class="card-text">Cupcake fruitcake macaroon donut</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    Simple Datatable
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Doc No</th>
                                                <th>Passport</th>
                                                <th>Ticket</th>
                                                <th>Passenger Name</th>
                                                <th>Travel Date</th>
                                                <th>Fare</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer->invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->doc_no }}</td>
                                                    <td>{{ $invoice->passport }}</td>
                                                    <td>{{ $invoice->ticket }}</td>
                                                    <td>{{ $invoice->passenger }}</td>
                                                    <td>{{ $invoice->travel_date }}</td>
                                                    <td>{{ $invoice->fare }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
        
                        </section>
                       
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
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush