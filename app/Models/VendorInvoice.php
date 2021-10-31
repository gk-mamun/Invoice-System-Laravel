<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_no',
        'passport',
        'ticket',
        'pnr',
        'passenger',
        'sector',
        'travel_date',
        'fare',
        'total',
        'type_id',
        'customer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
