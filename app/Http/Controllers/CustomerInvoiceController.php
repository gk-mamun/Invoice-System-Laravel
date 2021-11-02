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


    public function getSingleInvoiceData(Request $request)
    {
        $invoice_id = $request->invoiceId;

        $invoice = CustomerInvoice::find($invoice_id);

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
        
        $oldInvoice->passport = $request->passport;
        $oldInvoice->ticket = $request->ticket;
        $oldInvoice->pnr = $request->pnr;
        $oldInvoice->passenger = $request->passenger;
        $oldInvoice->sector = $request->sector;
        $oldInvoice->travel_date = $request->travel_date;
        $oldInvoice->fare = $request->fare;
        $oldInvoice->status = $request->status;
        $oldInvoice->type_id = $request->type;
        $oldInvoice->save();

        return $operation;
    }
}
