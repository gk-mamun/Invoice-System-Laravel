<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'email',
        'phone',
        'code',
    ];


    public function invoices()
    {
        return $this->hasMany(VendorInvoice::class);
    }
}
