<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_Details extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'Section',
        'status',
        'value_status',
        'note',
        'user',
        'payment_date'
    ];

    public function Invoices()
    {
        return $this->belongsTo(Invoices::class, 'id_Invoice');
    }
}
