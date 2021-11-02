<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CustomerInvoice;
use App\Models\VendorInvoice;
use App\Models\Customer;
use App\Models\Vendor;
use NumberToWords\NumberToWords;

class LaserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function generateLaser(Request $request) {
        // $this->validate($request, [
        //     'receiver_id' => 'required',
        //     'start_date' => 'required',
        //     'end_date' => 'required',
        // ]);
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();

        if($request->receiver == 'customer') {
            $receiver = Customer::find($request->receiver_id);
            $invoices = CustomerInvoice::where('customer_id', '=', $request->receiver_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        } 
        else if ($request->receiver == 'vendor') {
            $receiver = Vendor::find($request->receiver_id);
            $invoices = VendorInvoice::where('vendor_id', '=', $request->receiver_id)->whereBetween('created_at', [$start_date, $end_date])->get();
        }
        

        $totalFare = 0.00;
        $totalCredit = 0.00;
        $totalBalance = 0.00;
        
        // create the number to words
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        

        $html = '';

        if ( $invoices->count() > 0 ) {
            $html .= '
            <div class="card">
                <div class="card-body" style="padding: 2rem 2.5rem; background-color: #fff;">
                    <div id="laser">
                        <div class="laser-header">
                            <div class="logo-container">
                                <img src="../images/logo/company-logo.png" alt="">
                            </div>
                            <div class="company-info">
                                <h1>World Wide Insurance</h1>
                            </div>
                        </div>
                        <div id="laser-body">
                            <div class="laser-body-inner-container laser-receiver p-2">
                                <h5 class="text-center mb-3">Statement of Account</h5>
                                <div class="laser-receiver-inner p-2">
                                    <div>
                                        <h5>' . $receiver->title . '</h5>
                                        <p>' . $receiver->address . '</p>
                                        <br>
                                        <div class="laser-inner-row">
                                            <h6><span>Tel</span>:</h6>
                                            <p>' . $receiver->phone . '</p>
                                        </div>
                                        <div class="laser-inner-row">
                                            <h6><span>Email</span>:</h6>
                                            <p>' . $receiver->email . '</p>
                                        </div>
                                        <br>
                                        <div class="laser-inner-row">
                                            <h6><span>Cost Center</span>:</h6>
                                            <p>Default</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="laser-inner-row">
                                            <h6><span>Code</span>:</h6>
                                            <p>' . $receiver->code . '</p>
                                        </div>
                                        <div class="laser-inner-row">
                                            <h6><span>Currency</span>:</h6>
                                            <p>BDT</p>
                                        </div>
                                        <br>
                                        <div class="laser-inner-row">
                                            <h6><span>Period</span>:</h6>
                                            <p>' . date_format(date_create($request->start_date),"d/m/Y") . "-" . date_format(date_create($request->end_date),"d/m/Y") . '</p>
                                        </div>
                                        <div class="laser-inner-row">
                                            <h6><span>Department</span>:</h6>
                                            <p>All</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="">
                                <div class="">
                                    <table class="table table-bordered mb-0" id="laser-data-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Doc No.</th>
                                                <th>Ticket</th>
                                                <th>Passenger</th>
                                                <th>Sector</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                                <th>Travel Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        
            foreach( $invoices as $invoice ) {
                $html .= '                  
                    <tr>
                        <td>'. date_format($invoice->created_at,"d/m/Y") .'</td>
                        <td>'. $invoice->doc_no .'</td>
                        <td>'. $invoice->ticket .'</td>
                        <td>'. $invoice->passenger .'</td>
                        <td>'. $invoice->sector .'</td>
                        <td>'. number_format($invoice->fare , 2) .'</td>
                        <td>'. number_format($invoice->credit , 2) .'</td>
                        <td>'. number_format($invoice->total , 2) .'</td>
                        <td>'. date_format(date_create($invoice->travel_date),"d/m/Y") .'</td>
                    </tr>
                ';  
                $totalFare += $invoice->fare;
                $totalCredit += $invoice->credit;
                
            }
            $totalBalance = $totalFare - $totalCredit;                  
                                        
            $html .= '                      <tr id="row-total">
                                                <td colspan="5">Total</td>
                                                <td>' . number_format($totalFare, 2) . '</td>
                                                <td>' . number_format($totalCredit, 2) . '</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr id="total-amount">
                                                <td colspan="3">Amount Due To Us: ' . number_format($totalBalance, 2) . '</td>
                                                <td colspan="6">BANGLADESHI TAKA ' . ucwords($numberTransformer->toWords($totalBalance)) . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        else {
            $html .= 
                '<div class="card">
                    <div class="card-body">
                        <h3 class="text-center">There is no record between those date.</h3>
                    </div>
                </div>';
        }

        return $html;
    }
}
