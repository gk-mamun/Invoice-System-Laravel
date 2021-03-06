<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
        return $this->hasMany(CustomerInvoice::class);
    }

    
}
