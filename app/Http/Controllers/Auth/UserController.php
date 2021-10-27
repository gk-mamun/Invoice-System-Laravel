<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
}
