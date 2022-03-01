<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\CustomerInvoice;
use App\Models\VendorInvoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $customers = Customer::all();
        $customerNumber = Customer::all()->count();
        $vendorNumber = Vendor::all()->count();
        $invoices = CustomerInvoice::all();
        $recentCustomers = Customer::orderBy('created_at', 'desc')->limit(3)->get();
        $recentVendors = Vendor::orderBy('created_at', 'desc')->limit(3)->get();
        $users = User::where('id', '!=', auth()->id())->limit(3)->get();
        $totalSpendings = VendorInvoice::where('type', '!=', 'payment')->sum('fare');

        $sales = CustomerInvoice::select(DB::raw("(SUM(fare)) as total_sale"),DB::raw("MONTHNAME(created_at) as monthname"))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('monthname')
                            ->get();


        $revenue = 0.00;
        
        foreach($invoices as $invoice) {
            $revenue += $invoice->fare;
        }

        $profit = round(($revenue - $totalSpendings), 2);

        return view('index', [
            'revenue' => number_format($revenue , 2),
            'customerNumber' => $customerNumber,
            'vendorNumber' => $vendorNumber,
            'totalInvoice' => $invoices->count(),
            'recentCustomers' => $recentCustomers,
            'recentVendors' => $recentVendors,
            'sales' => $sales,
            'users' => $users,
            'totalSpending' => $totalSpendings,
            'profit' => $profit,
        ]);
    }

    public function showHome()
    {
        return view('index');
    }
}
