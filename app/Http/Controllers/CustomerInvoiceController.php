<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInvoice;

class CustomerInvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function readCustomerInvoices($id) 
    {
        $invoices = CustomerInvoice::where('customer_id', '=', $id)->get();

        $html = '';

        if($invoices->count() > 0) {
            $html .= '
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Doc No</th>
                                    <th>Passport</th>
                                    <th>Ticket</th>
                                    <th>Passenger Name</th>
                                    <th>Travel Date</th>
                                    <th>Status</th>
                                    <th>Fare</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th style="min-width: 136px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
            ';

        
            foreach($invoices as $invoice) {
                $html .= '
                    <tr>
                        <td>' . date_format(date_create($invoice->created_at),"d/m/Y") . '</td>
                        <td>' . $invoice->doc_no . '</td>
                        <td>' . $invoice->passport . '</td>
                        <td>' . $invoice->ticket . '</td>
                        <td>' . $invoice->passenger . '</td>
                        <td>' . $invoice->travel_date . '</td>
                        <td>' . ucwords($invoice->status) . '</td>
                        <td>' . $invoice->fare . '</td>
                        <td>' . $invoice->credit . '</td>
                        <td>' . $invoice->total . '</td>
                        <td>
                            <button class="btn btn-success icon invoice-update-btn" data-bs-toggle="modal" data-bs-target="#editInvoiceModal" data-id="' . $invoice->id . '" data-customerid="' . $id . '"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-info icon invoice-void-btn" data-bs-toggle="modal" data-bs-target="#voidInvoiceModal" data-id="' . $invoice->id . '" data-customerid="' . $id . '" data-fare="' . $invoice->fare . '"><i class="bi bi-badge-vo"></i></button>
                            <button class="btn btn-danger icon invoice-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteInvoiceModal" data-id="' . $invoice->id . '"  data-customerid="' . $id . '"><i class="bi bi-trash-fill"></i></button>
                        </td>
                </tr>
                ';          
            }

        }
        else {
            $html .= '
                <div class="card">
                    <div class="card-body text-center p4">
                        <p>There is no records</p>
                    </div>
                </div>
            ';
        }


        
        
        return $html;
    }


    public function getSingleInvoiceData($id)
    {
        $invoice = CustomerInvoice::find($id);

        return $invoice;
    }


    public function updateCustomerInvoice(Request $request)
    {
        $lastInvoice = CustomerInvoice::where('customer_id', '=', $request->customer_id)->orderBy('id', 'desc')->first();

        $updateInvoiceId = $request->edit_invoice_id;

        $oldInvoice = CustomerInvoice::find($updateInvoiceId);
        

        $allInvoiceToUpdate = CustomerInvoice::where('customer_id', '=', $request->customer_id)
                                             ->where('id', '>=', $updateInvoiceId)
                                             ->where('id', '<=', $lastInvoice->id)
                                             ->get();
        $operation = '';
        
         $oldFare = $oldInvoice->fare;
         $newFare = $request->fare;   

        if ($oldFare > $newFare) {
            $amount = $oldFare - $newFare;
            $operation = 'Subtraction';
            foreach($allInvoiceToUpdate as $invoice) {
                $invoiceToUpdateTotal = CustomerInvoice::find($invoice->id);
                $invoiceToUpdateTotal->total = $invoiceToUpdateTotal->total - $amount;
                $invoiceToUpdateTotal->save();
            }
        } 
        else {
            $amount = $newFare - $oldFare;
            $operation = 'Addition';
            foreach($allInvoiceToUpdate as $invoice) {
                $invoiceToUpdateTotal = CustomerInvoice::find($invoice->id);
                $invoiceToUpdateTotal->total = $invoiceToUpdateTotal->total + $amount;
                $invoiceToUpdateTotal->save();
            }
        }
        
        if(!empty($request->passport)) {
            $oldInvoice->passport = $request->passport;
        }
        if(!empty($request->ticket)) {
            $oldInvoice->ticket = $request->ticket;
        }
        if(!empty($request->pnr)) {
            $oldInvoice->pnr = $request->pnr;
        }
        if(!empty($request->passenger)) {
            $oldInvoice->passenger = $request->passenger;
        }
        if(!empty($request->sector)) {
            $oldInvoice->sector = $request->sector;
        }
        if(!empty($request->travel_date)) {
            $oldInvoice->travel_date = $request->travel_date;
        }

        $oldInvoice->fare = $request->fare;
        $oldInvoice->status = $request->status;
        $oldInvoice->save();


    }

    public function deleteCustomerInvoice(Request $request)
    {
        $lastInvoice = CustomerInvoice::where('customer_id', '=', $request->customer_id)->orderBy('id', 'desc')->first();

        $deleteInvoiceId = $request->delete_invoice_id;

        $deletingInvoice = CustomerInvoice::find($deleteInvoiceId);

        $invoicePrice = $deletingInvoice->fare;

        $allInvoiceToUpdate = CustomerInvoice::where('customer_id', '=', $request->customer_id)
                                             ->where('id', '>=', $deleteInvoiceId)
                                             ->where('id', '<=', $lastInvoice->id)
                                             ->get();
        
        foreach($allInvoiceToUpdate as $invoice) {
            $invoiceToUpdateTotal = CustomerInvoice::find($invoice->id);
            $invoiceToUpdateTotal->total = $invoiceToUpdateTotal->total - $invoicePrice;
            $invoiceToUpdateTotal->save();
        }

        $deletingInvoice->delete();

    }

    public function voidCustomerInvoice(Request $request)
    {
        $lastInvoice = CustomerInvoice::where('customer_id', '=', $request->customer_id)->orderBy('id', 'desc')->first();

        $voidInvoiceId = $request->void_invoice_id;

        $oldInvoice = CustomerInvoice::find($voidInvoiceId);
        

        $allInvoiceToUpdate = CustomerInvoice::where('customer_id', '=', $request->customer_id)
                                             ->where('id', '>=', $voidInvoiceId)
                                             ->where('id', '<=', $lastInvoice->id)
                                             ->get();
        $operation = '';
        
        $oldFare = $oldInvoice->fare;
        $newFare = $request->fare;   

        if ($oldFare > $newFare) {
            $amount = $oldFare - $newFare;
            $operation = 'Subtraction';
            foreach($allInvoiceToUpdate as $invoice) {
                $invoiceToUpdateTotal = CustomerInvoice::find($invoice->id);
                $invoiceToUpdateTotal->total = $invoiceToUpdateTotal->total - $amount;
                $invoiceToUpdateTotal->save();
            }
        } 
        else {
            $amount = $newFare - $oldFare;
            $operation = 'Addition';
            foreach($allInvoiceToUpdate as $invoice) {
                $invoiceToUpdateTotal = CustomerInvoice::find($invoice->id);
                $invoiceToUpdateTotal->total = $invoiceToUpdateTotal->total + $amount;
                $invoiceToUpdateTotal->save();
            }
        }
        
        
        $oldInvoice->fare = $request->fare;
        $oldInvoice->status = $request->status;
        $oldInvoice->save();

        return $operation;
    }

    public function customerPayment(Request $request)
    {
        $amount = $request->payment_amount;
        $status = $request->payment_media;

        // Create document no for payment invoice
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

        $docNo = 'ATI' . $code;

        // Find last invoice for this customer
        $lastInvoiceForThisCustomer = CustomerInvoice::where('customer_id', '=', $request->customer_id)->orderBy('id', 'desc')->first();

        $newTotal = $lastInvoiceForThisCustomer->total - $amount;

        $paymentInvoice = new customerInvoice();
        $paymentInvoice->doc_no = $docNo;
        $paymentInvoice->status = $status;
        $paymentInvoice->credit = $amount;
        $paymentInvoice->total = $newTotal;
        $paymentInvoice->type_id = 1;
        $paymentInvoice->customer_id = $request->customer_id;
        $paymentInvoice->user_id = $newTotal;
        $paymentInvoice->save();
        

    }

}
