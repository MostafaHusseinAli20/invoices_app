<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_Attchment extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'invoice_number',
        'created_by',
        'invoice_id'
    ];

    public function Invoices()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }
}
