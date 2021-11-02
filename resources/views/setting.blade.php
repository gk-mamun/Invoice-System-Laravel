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
                        <div class="page-heading" style="margin-bottom: 0px;"><h3>Profile Settings</h3></div>
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
                                data-bs-toggle="modal" data-bs-target="#updateProfileModal" id="update-btn">
                                Update Profile
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body" id="user-container">
                                            
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


            <!-- update profile Modal -->
            



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



            // Read all users
            function readUsersData() {
                $.ajax({
                    url: "{{ route('get-user-data') }}",
                    type: "GET",
                    success: function(data) {
                        $('#user-container').html(data);
                        profileUpdateForm = $('#profile-update-form');
                    },
                    error: function (errormessage) {
                        console.log(errormessage.responseText);
                    }
                });
            };
            readUsersData();


            // Create customer functionalities
            // var profileUpdateForm = $('#profile-update-form');

            profileUpdateForm.on('submit', function(e) {
                e.preventDefault();
                
                var loader = $('#update-profile-form-loader');

                var password = $('#password').val();
                var password_confirmation = $('#confirm-password').val();
                

                if(password != '') {
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
                }
                else {
                    console.log('Password Empty');
                }
                

                

            });


        });

    </script>
@endpush