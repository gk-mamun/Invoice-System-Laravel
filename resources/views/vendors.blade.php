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
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <!-- button trigger for  Add new invoice type modal -->
                                <button type="button" class="btn btn-outline-primary block float-end"
                                data-bs-toggle="modal" data-bs-target="#addNewCustomerModal">
                                Add New Vendor
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-striped" id="vendorTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Type</th>
                                                        <th>Total Documents</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>Ticket</th>
                                                        <th>250</th>
                                                        <th>
                                                            <a href="{{ route('single-vendor', ['id' => 1]) }}" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                                                            <button class="btn btn-success icon" data-bs-toggle="modal" data-bs-target="#editTypeModal"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon" data-bs-toggle="modal" data-bs-target="#deleteTypeModal"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>Insurance</th>
                                                        <th>24</th>
                                                        <th>
                                                            <a href="{{ route('single-vendor', ['id' => 1]) }}" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                                                            <button class="btn btn-success icon"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>Gulf Health</th>
                                                        <th>82</th>
                                                        <th>
                                                            <a href="{{ route('single-vendor', ['id' => 1]) }}" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                                                            <button class="btn btn-success icon"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>hMushrif</th>
                                                        <th>18</th>
                                                        <th>
                                                            <button class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></button>
                                                            <button class="btn btn-success icon"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>Reissue</th>
                                                        <th>74</th>
                                                        <th>
                                                            <button class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></button>
                                                            <button class="btn btn-success icon"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>Hotel</th>
                                                        <th>250</th>
                                                        <th>
                                                            <button class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></button>
                                                            <button class="btn btn-success icon"><i class="bi bi-pencil-square"></i></button>
                                                            <button class="btn btn-danger icon"><i class="bi bi-trash-fill"></i></button>
                                                        </th>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
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


            <!-- Vertically Centered modal Modal -->
            <div class="modal fade" id="addNewCustomerModal" tabindex="-1" role="dialog"
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


            <!-- Vertically Centered modal Modal -->
            <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog"
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


            <!-- Vertically Centered modal Modal -->
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
        let table1 = document.querySelector('#vendorTable');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush