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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Users</h3></div>
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
                                data-bs-toggle="modal" data-bs-target="#createUserModal">
                                Create New Customer
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="users-table">
                                            
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
                        <p>2021 &copy; Lazer</p>
                    </div>
                    <div class="float-end">
                        <p>Developed <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="#">gk mamun</a></p>
                    </div>
                </div>
            </footer>


            <!-- Create User Modal -->
            <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create New User</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        {{-- Loader --}}
                        <div class="p-2 text-center" id="create-user-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="create-user-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Name</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Name..." id="user-name" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Email</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control" placeholder="Email..." id="user-email" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12" id="inner-form-alert">

                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-shield-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Confirm Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-shield-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>User Role</label>
                                                <select class="choices form-select" id="user-role" required>
                                                    <option value="staff" selected>Staff</option>
                                                    <option value="admin">Admin</option>
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
                                    <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Delete Customer Modal -->
            <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
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
                        <div class="p-2 text-center" id="delete-user-form-loader" style="display: none;">
                            <img src="{{ asset('vendors/svg-loaders/oval.svg') }}" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="delete-user-modal">
                            <input type="hidden" id="delete-user-id">
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


            // Alert function
            function showAlert(message, type) {
                var alertDiv = $('#alert');
                alertDiv.html(`<div class="alert alert-`+ type +` alert-dismissible show fade">
                                    `+message+`
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`);

            }

            // Show Delete Type data to modal
            function showDeleteUserData(btn) {
                btn.click(function() {
                    var deleteUserId = $('#delete-user-id');
                    deleteUserId.val($(this).data('id'));
                })
            }

            // Delete user
            var deleteUserForm = $('#delete-user-modal');

            deleteUserForm.on('submit', function(e) {
                e.preventDefault();

                var loader = $('#delete-user-form-loader');
                var deleteUserId = $('#delete-user-id').val();

                $.ajax({
                    url: "{{ route('delete-user') }}",
                    type: "POST",
                    data: {
                        deleteId: deleteUserId,
                    },
                    beforeSend: function() {
                        loader.show();
                    },
                    success: function(data) {
                        setTimeout(function() {
                            loader.hide();
                            $('#deleteUserModal').modal('hide');
                            showAlert("User is deleted successfully", "success");
                            readUsers();
                        }, 500);
                        
                    }
                });

            });


            // Read all users
            function readUsers() {
                $.ajax({
                    url: "{{ route('read-users') }}",
                    type: "GET",
                    success: function(data) {
                        $('#users-table').html(data);
                        var table1 = document.querySelector('#usersTable');
                        var dataTable = new simpleDatatables.DataTable(table1);
                        var deleteBtn = $('.user-delete-btn');
                        showDeleteUserData(deleteBtn);
                    },
                    error: function (errormessage) {
                        console.log(errormessage.responseText);
                    }
                });
            };
            readUsers();


            // Create customer functionalities
            var createUserForm = $('#create-user-form');

            createUserForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#create-user-form-loader');

                var name = $('#user-name').val();
                var email = $('#user-email').val();
                var password = $('#password').val();
                var password_confirmation = $('#confirm-password').val();
                var role = $('#user-role').val();

                if (password.length < 8) {
                    $('#inner-form-alert').html(`
                        <div class="alert alert-danger alert-dismissible show fade">
                            Password must be 8 characters or more.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(function(){ 
                        $('#inner-form-alert').html('');
                     }, 3000);
                } 
                else {
                    if (password == password_confirmation) {
                        $.ajax({
                            url: "{{ route('create-user') }}",
                            type: "POST",
                            data: {
                                name,
                                email,
                                password,
                                password_confirmation,
                                role
                            },
                            beforeSend: function() {
                                loader.show();
                            },
                            success: function(data) {
                                setTimeout(function() {
                                    loader.hide();
                                    $('#createUserModal').modal('hide');
                                    showAlert("User is created successfully", "success");
                                    readUsers();
                                }, 500);
                                
                            }
                        });
                    } 
                    else {
                        $('#inner-form-alert').html(`
                            <div class="alert alert-danger alert-dismissible show fade">
                                Password do not match.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        `);
                        setTimeout(function(){ 
                            $('#inner-form-alert').html('');
                        }, 3000);
                    }
                }

            });


        });

    </script>
@endpush