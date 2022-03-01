<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerInvoice;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        return view('users');
    }

    // Create User
    public function createUser(Request $request)
    {
        // Validate data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

         // Create user
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return;
    }

    // Read Users
    public function readUser()
    {
        $users = User::where('id', '!=', auth()->id())->orderBy('created_at', 'desc')->get();

        $html = '
        <table class="table table-striped" id="usersTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        ';

        $count = 1;

        foreach($users as $user) {
            $html .= '
                <tr>
                    <th>'. $count .'</th>
                    <th>'. $user->name .'</th>
                    <th>'. $user->email .'</th>
                    <th>'. ucwords($user->role) .'</th>
                    <th>
                        <a href="/single-user/'.$user->id.'" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                        <button class="btn btn-danger icon user-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-id="'. $user->id .'"><i class="bi bi-trash-fill"></i></button>
                    </th>
                </tr>
            ';

            $count++;
        }

        $html .= '
            </tbody>
            </table>
        ';

        return $html;
    }

    // Delete User
    public function deleteUser(Request $request) {
        $deleteId = $request->deleteId;

        $user = User::find($deleteId);

        $user->delete();
        
        return;
    }

    // Show Setting
    public function showSetting() {
        
        return view('setting');
    }

    // Get single user data
    public function getUserData()
    {
        $user = User::find(auth()->id());

        $html = '';

        $html .= '
                <div class="row" id="user-row">
                    <div class="col-4">
                        <div id="avatar-container">';
        
        if($user->avatar == null) {
            $html .= '<img src="../images/customers/default.jpg" alt=""> ';
        }
        else {
            $html .= '<img src="../images/users/'. $user->avatar .'">';
        }
                           
                              
        $html .= '</div>
                    </div>
                    <div class="col-8">
                        <h1>'. $user->name .'</h1>
                        <h6>Email: '. $user->email .'</h6>
                        <br>';
        if($user->phonenumber == null) {
            $html .= '<p>Phone: Not Available</p>';
        } 
        else {
            $html .= '<p>Phone: '. $user->phonenumber .'</p>';
        }
        $html .= '       
                    </div>
                </div>
            ';

        $html .= '
            <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Update Profile</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        
                        <div class="p-2 text-center" id="update-profile-form-loader" style="display: none;">
                            <img src="../vendors/svg-loaders/oval.svg" class="m-auto" style="width: 3rem" alt="loader">
                        </div>

                        <form class="form form-vertical" id="profile-update-form">
                            <div class="modal-body">
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Name</label>
                                                <div class="position-relative">
                                                    <input type="text" name="name" class="form-control" placeholder="Name..." id="edit-user-name" required value="'. $user->name .'">
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
                                                    <input type="email" name="email" class="form-control" placeholder="Email..." id="edit-user-email" required value="'. $user->email .'">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group has-icon-left mb-4">
                                                <label>Phone Number</label>
                                                <div class="position-relative">
                                                    <input type="text" name="phone" class="form-control" placeholder="Phone number..." id="edit-user-phone" required value="'. $user->phonenumber .'">
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
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" >
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
                                                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-shield-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <br>
                                                <small>If you do not want to change, keep it empty</small>
                                                <div class="position-relative">
                                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="role"  value="'. $user->role .'"/>
                                        <input type="hidden" name="id" value="' .$user->id . '" />
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        ';

        return $html;
    }

    // Read single user data
    public function singleUser($id)
    {
        $user = User::find($id);
        $totalUserSale = CustomerInvoice::where('user_id', '=', $id)
                                        ->where('type', '!=', 'payment')
                                        ->where('type', '!=', 'Payment')
                                        ->sum('fare');

        return view('single-user', [
            'user' => $user,
            'totalSale' => $totalUserSale,
        ]);
    }


    // Update user data
    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        
        if(!empty($request->name)) {
            $user->name = $request->name;
        }
        if(!empty($request->email)) {
            $user->email = $request->email;
        }
        if(!empty($request->phone)) {
            $user->phonenumber = $request->phone;
        }
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        if($request->hasfile('avatar')) {
            $avatar_name = 'avatar_' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('images/users'), $avatar_name);
            $user->avatar = $avatar_name;
        }

        $user->save();

    }


    // Get user sales data
    public function getUserSales()
    {
        $userSales = CustomerInvoice::where('user_id', '=', auth()->id())->where('type', '!=', 'payment')->sum('fare');
        $numInvoices = CustomerInvoice::where('user_id', '=', auth()->id())->where('type', '!=', 'payment')->count();

        $html = '
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 200px;">
                            <h1 class="d-flex" style="font-size: 54px;"><span style="font-size: 20px;">$</span>'. $userSales .'</h1>
                            <p style="font-size: 20px; font-weight: bold;">Total Sales Amount</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 200px;">
                            <h1 class="d-flex" style="font-size: 54px;">'. $numInvoices .'</h1>
                            <p style="font-size: 20px; font-weight: bold;">Total Number of Invoice</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        ';

        return $html;
    }



}
