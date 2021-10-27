<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('single-vendor');
    }
}
