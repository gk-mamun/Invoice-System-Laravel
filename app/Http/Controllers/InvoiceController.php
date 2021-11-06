<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\CustomerInvoice;
use App\Models\VendorInvoice;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $customers = Customer::all();
        $vendors = Vendor::all();
        

        return view('invoices', [
            'customers' => $customers,
            'vendors' => $vendors,
       
        ]);
    }

    // Read all invoice
    public function readInvoices()
    {
       
        $customerInvoices = CustomerInvoice::orderBy('created_at', 'desc')->get();
        $vendorInvoices = VendorInvoice::orderBy('created_at', 'desc')->get();
        

        $html = '
            <h3>Customer Invoice</h3>
            <table class="table table-striped" id="customerTable">
            <thead>
                <tr>
                    <th>Doc No.</th>
                    <th>Passport</th>
                    <th>PNR</th>
                    <th>Passenger</th>
                    <th>Travel Date</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
               
            
        ';

        foreach($customerInvoices as $invoice) {
            $html .= '
                <tr>
                <th>'. $invoice->doc_no .'</th>
                <th>'. $invoice->passport .'</th>
                <th>'. $invoice->pnr .'</th>
                <th>'. $invoice->passenger .'</th>
                <th>'. $invoice->travel_date .'</th>
                <th>'. $invoice->type .'</th>
                ';
            
            
        }

        $html .= '
            </tbody>
            </table>
            <br>
            <hr>
            <br>
            <h3>Vendor Invoice</h3>
            <table class="table table-striped" id="vendorTable">
            <thead>
                <tr>
                    <th>Doc No.</th>
                    <th>Passport</th>
                    <th>PNR</th>
                    <th>Passenger</th>
                    <th>Travel Date</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
        ';

        foreach($vendorInvoices as $invoice) {
            $html .= '
                <tr>
                <th>'. $invoice->doc_no .'</th>
                <th>'. $invoice->passport .'</th>
                <th>'. $invoice->pnr .'</th>
                <th>'. $invoice->passenger .'</th>
                <th>'. $invoice->travel_date .'</th>
                <th>'. $invoice->type .'</th>
                ';
        }

        $html .= '
            </tbody>
            </table>
        ';

        return $html;
    }


    // Create invoice for both customer & vendor
    public function storeInvoice(Request $request)
    {

        $last_customer_invoice = CustomerInvoice::where('customer_id', '=', $request->customer)->latest()->first();;
        $last_vendor_invoice = VendorInvoice::where('vendor_id', '=', $request->vendor)->latest()->first();;

        // Create customer invoice
        $customer = new CustomerInvoice();
        $customer->doc_no = $request->docNo;
        if(!empty($request->passport)) {
            $customer->passport = $request->passport;
        }
        if(!empty($request->ticket)) {
            $customer->ticket = $request->ticket;
        }
        if(!empty($request->pnr)) {
            $customer->pnr = $request->pnr;
        }
        if(!empty($request->passenger)) {
            $customer->passenger = $request->passenger;
        }
        if(!empty($request->sector)) {
            $customer->sector = $request->sector;
        }
        if(!empty($request->travelDate)) {
            $customer->travel_date = $request->travelDate;
        }

        $customer->fare = $request->sellingFare;
        if($last_customer_invoice == null) {
            $customer->total = $request->sellingFare;
        } 
        else {
            $customer->total = $last_customer_invoice->total + $request->sellingFare;
        }
        $customer->type = $request->type;
        $customer->customer_id = $request->customer;
        $customer->user_id = auth()->id();
        $customer->save();

        // create vendor invoice
        $vendor = new VendorInvoice();
        $vendor->doc_no = $request->docNo;

        if(!empty($request->passport)) {
            $vendor->passport = $request->passport;
        }
        if(!empty($request->ticket)) {
            $vendor->ticket = $request->ticket;
        }
        if(!empty($request->pnr)) {
            $vendor->pnr = $request->pnr;
        }
        if(!empty($request->passenger)) {
            $vendor->passenger = $request->passenger;
        }
        if(!empty($request->sector)) {
            $vendor->sector = $request->sector;
        }
        if(!empty($request->travelDate)) {
            $vendor->travel_date = $request->travelDate;
        }
        
        $vendor->fare = $request->purchasedFare;
        if($last_vendor_invoice == null) {
            $vendor->total = $request->purchasedFare;
        } 
        else {
            $vendor->total = $last_vendor_invoice->total + $request->purchasedFare;
        }
        $vendor->type = $request->type;
        $vendor->vendor_id = $request->vendor;
        $vendor->save();

        return $request->passport;;


    }


    // Get last document
    public function getLastInvoiceDocNo() 
    {
        $lastInvoice = CustomerInvoice::orderBy('created_at', 'desc')->first();

        if($lastInvoice != '') {
            $codeStr = substr($lastInvoice->doc_no, 3);
            $increment = $codeStr + 1;
            if(strlen($increment) == 1) {
                $code = '000' . $increment;
            }
            else if(strlen($increment) == 2) {
                $code = '00' . $increment;
            }
            else if(strlen($increment) == 3) {
                $code = '0' . $increment;
            }
            else {
                $code = $increment;
            }
        }
        else {
            $code = '0001';
        }
        
        return $code;
    }
}
