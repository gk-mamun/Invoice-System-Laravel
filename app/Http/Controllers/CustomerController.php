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
        $customer = Customer::find($id);
        
        return view('single-customer', ['customer' => $customer]);
    }

    // Create Customer
    public function store(Request $request)
    {

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_code' => 'required',
            'customer_address' => 'required',
        ]);

        $customer = new Customer();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = time() . '_' . 'avatar.' . $file->extension();
            $file->move(public_path('images/customers'), $file_name);

            $customer->avatar = $file_name;
        }

        $customer->title = $request->customer_name;
        $customer->email = $request->customer_email;
        $customer->phone = $request->customer_phone;
        $customer->code = $request->customer_code;
        $customer->address = $request->customer_address;
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
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_code' => 'required',
            'customer_address' => 'required',
        ]);

        $customer = Customer::find($request->customer_id);
        $customer->title = $request->customer_name;
        $customer->email = $request->customer_email;
        $customer->phone = $request->customer_phone;
        $customer->code = $request->customer_code;
        $customer->address = $request->customer_address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = time() . '_' . 'avatar.' . $file->extension();
            $file->move(public_path('images/customers'), $file_name);

            $customer->avatar = $file_name;
        }
        
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
