<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('customers');
    }

    // Read Customers
    public function readCustomers()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();

        $html = '
        <table class="table table-striped" id="table1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        ';

        foreach($customers as $customer) {
            $html .= '
                <tr>
                    <th>'. $customer->code .'</th>
                    <th>'. $customer->title .'</th>
                    <th>'. $customer->email .'</th>
                    <th>'. $customer->phone .'</th>
                    <th>
                        <a href="/customers/'. $customer->id .'" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                        <button class="btn btn-success icon customer-update-btn" data-bs-toggle="modal" data-bs-target="#editCustomerModal" data-id="'. $customer->id .'"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger icon customer-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal" data-id="'. $customer->id .'"><i class="bi bi-trash-fill"></i></button>
                    </th>
                </tr>
            ';
        }

        $html .= '
            </tbody>
            </table>
        ';

        return $html;


    }

    // Get Single Customer
    public function getSingleCustomer($id)
    {
        return view('single-customer');
    }

    // Create Customer
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'code' => 'required',
            'address' => 'required',
        ]);

        $customer = new Customer();
        $customer->title = $request->title;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->code = $request->code;
        $customer->address = $request->address;
        $customer->save();

    }

    // Get Customer Data
    public function getCustomerToUpdate($id) 
    {
        $customer = Customer::find($id);

        return $customer;
    }

    // Update Customer
    public function updateCustomer(Request $request)
    {
        $this->validate($request, [
            'newId' => 'required',
            'newTitle' => 'required',
            'newEmail' => 'required',
            'newPhone' => 'required',
            'newCode' => 'required',
            'newAddress' => 'required',
        ]);

        $customer = Customer::find($request->newId);
        $customer->title = $request->newTitle;
        $customer->email = $request->newEmail;
        $customer->phone = $request->newPhone;
        $customer->code = $request->newCode;
        $customer->address = $request->newAddress;
        $customer->save();

    }


    // Delete Customer 
    public function deleteCustomer(Request $request)
    {
        $this->validate($request, [
            'deleteId' => 'required',
        ]);

        $customer = Customer::find($request->deleteId);
        $customer->delete();
        
    }    
}
