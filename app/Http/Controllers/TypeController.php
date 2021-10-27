<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceType;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('types');
    }


    public function readTypes()
    {
        $types = InvoiceType::orderBy('created_at', 'desc')->get();

        

        $html = '
            <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="invoice-type-table-body">
               
            
        ';
        $count = 1;
        foreach($types as $type) {
            $html .= '
                <tr>
                <th>'. $count .'</th>
                <th>'. $type->title .'</th>
                <th>
                    <button class="btn btn-success icon type-update-btn" data-bs-toggle="modal" data-bs-target="#editTypeModal" data-id="'. $type->id .'"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger icon type-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteTypeModal" data-id="'. $type->id .'"><i class="bi bi-trash-fill"></i></button>
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

    // create type
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $type = new InvoiceType();
        $type->title = $request->title;
        $type->save();

    }

    // Get Type date 
    public function getSingleType($id) 
    {
        $type = InvoiceType::find($id);

        return $type;
    }

    
    // Update Type
    public function updateType(Request $request)
    {
        $this->validate($request, [
            'newId' => 'required',
            'newTitle' => 'required',
        ]);

        $type = InvoiceType::find($request->newId);
        $type->title = $request->newTitle;
        $type->save();

    }

    // Delete Type
    public function deleteType(Request $request)
    {
        $this->validate($request, [
            'deleteId' => 'required',
        ]);

        $type = InvoiceType::find($request->deleteId);
        $type->delete();
        
    }
}
