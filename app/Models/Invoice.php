<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    // multiple invoice belongs to one customer
      public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}