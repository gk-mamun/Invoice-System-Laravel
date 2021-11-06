<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        
        return view('vendors');
    }

    public function getSingleVendor($id)
    {
        $vendor = Vendor::find($id);

        return view('single-vendor', [
            'vendor' => $vendor,
        ]);
    }

    // add vendor
    public function store(Request $request) {

        $this->validate($request, [
            'vendor_name' => 'required',
            'vendor_email' => 'required',
            'vendor_phone' => 'required',
            'vendor_code' => 'required',
            'vendor_address' => 'required',
        ]);

        $vendor = new Vendor();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = time() . '_' . 'avatar.' . $file->extension();
            $file->move(public_path('images/vendor'), $file_name);

            $vendor->avatar = $file_name;
        }

        $vendor->title = $request->vendor_name;
        $vendor->email = $request->vendor_email;
        $vendor->phone = $request->vendor_phone;
        $vendor->code = $request->vendor_code;
        $vendor->address = $request->vendor_address;
        $vendor->save();
        return;
    }


    // Read all vendors
    public function readVendors() {
        $vendors = Vendor::orderBy('created_at', 'desc')->get();

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

        foreach($vendors as $vendor) {
            $html .= '
                <tr>
                    <th>'. $vendor->code .'</th>
                    <th>'. $vendor->title .'</th>
                    <th>'. $vendor->email .'</th>
                    <th>'. $vendor->phone .'</th>
                    <th>
                        <a href="/our-vendors/'. $vendor->id .'" class="btn btn-primary icon" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-eye"></i></a>
                        <button class="btn btn-success icon vendor-update-btn" data-bs-toggle="modal" data-bs-target="#editVendorModal" data-id="'. $vendor->id .'"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger icon vendor-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteVendorModal" data-id="'. $vendor->id .'"><i class="bi bi-trash-fill"></i></button>
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


    // Get Vendor Data
    public function getVendorToUpdate($id) 
    {
        $vendor = Vendor::find($id);

        return $vendor;
    }


    // Update Customer
    public function updateVendor(Request $request)
    {
        $this->validate($request, [
            'vendor_name' => 'required',
            'vendor_email' => 'required',
            'vendor_phone' => 'required',
            'vendor_code' => 'required',
            'vendor_address' => 'required',
        ]);

        $vendor = Vendor::find($request->vendor_id);
        $vendor->title = $request->vendor_name;
        $vendor->email = $request->vendor_email;
        $vendor->phone = $request->vendor_phone;
        $vendor->code = $request->vendor_code;
        $vendor->address = $request->vendor_address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = time() . '_' . 'avatar.' . $file->extension();
            $file->move(public_path('images/vendor'), $file_name);

            $vendor->avatar = $file_name;
        }
        
        $vendor->save();

    }


    // Delete Customer 
    public function deleteVendor(Request $request)
    {
        $this->validate($request, [
            'deleteId' => 'required',
        ]);

        $vendor = Vendor::find($request->deleteId);
        $vendor->delete();
        
    }  
}
